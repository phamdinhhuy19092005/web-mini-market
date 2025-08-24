<?php

namespace App\Services;

use App\Enum\DepositStatusEnum;
use App\Enum\DiscountTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Enum\PaymentOptionTypeEnum;
use App\Enum\PaymentStatusEnum;
use App\Events\OrderCreated;
use App\Mail\OrderCreatedMail;
use App\Models\Coupon;
use App\Models\DepositTransaction;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\Province;
use App\Models\UsedDiscount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderService extends BaseService
{
    public $orderRepository;
    public $depositService;
    public $paymentOptionService;
    public $shippingOptionService;
    public $userService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        DepositService $depositService,
        PaymentOptionService $paymentOptionService,
        ShippingOptionService $shippingOptionService,
        UserService $userService
    ) {
        $this->orderRepository = $orderRepository;
        $this->depositService = $depositService;
        $this->paymentOptionService = $paymentOptionService;
        $this->shippingOptionService = $shippingOptionService;
        $this->userService = $userService;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->orderRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('title', 'like', "%{$query}%")
                    ->orWhere('sku', 'like', "%{$query}%");
            })
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getOrderWithItemsByUserId(int $userId)
    {
        return Order::with([
                'items.inventory',
                'user',
                'paymentOption',
                'coupon',
                'shippingOption',
                'usedDiscounts',
            ])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function statisticOrderStatus($status, $data = [])
    {
        $query = $this->orderRepository->model()::query()->where('order_status', $status);

        if ($month = data_get($data, 'month')) {
            $query->whereMonth('updated_at', $month);
        }

        if ($year = data_get($data, 'year')) {
            $query->whereYear('updated_at', $year);
        }

        return $query->count();
    }

    public function applyCoupon(int $orderId, string $couponCode): Order
    {
        return DB::transaction(function () use ($orderId, $couponCode) {
            $order = Order::findOrFail($orderId);
            $coupon = Coupon::where('code', $couponCode)->firstOrFail();

            if ($order->usedDiscounts()->where('coupon_id', $coupon->id)->exists()) {
                throw new \Exception('Coupon đã được sử dụng cho đơn hàng này');
            }

            $discountAmount = 0;

            if ($coupon->type === DiscountTypeEnum::PERCENTAGE->value) {
                $discountAmount = $order->grand_total * ($coupon->value / 100);
            } elseif ($coupon->type === DiscountTypeEnum::FIXED->value) {
                $discountAmount = $coupon->value;
            }

            // Lưu vào order_discounts
            $order->discounts()->create([
                'discountable_id'   => $coupon->id,
                'discountable_type' => Coupon::class,
                'discount_value'    => $discountAmount,
                'discount_type'     => $coupon->type, // lưu type nếu muốn
            ]);
            $order->usedDiscounts()->create([
                'user_id'   => $order->user_id,
                'coupon_id' => $coupon->id,
                'order_id'  => $order->id,
                'used_at'   => now(),
            ]);

            $order->grand_total = max(0, $order->grand_total - $discountAmount);
            $order->save();

            return $order->fresh();
        });
    }

    public function createOrderUserWithCoupon(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = $this->createUser($data);

            $cartItems = data_get($data, 'cart_items', []);
            if (empty($cartItems)) {
                throw new \Exception('Giỏ hàng rỗng. Vui lòng thêm sản phẩm.');
            }

            foreach ($cartItems as $item) {
                $inventory = Inventory::findOrFail($item['inventory_id']);
                $price = $inventory->offer_price ?? $inventory->sale_price ?? $inventory->final_price;

                $exists = $order->items()->where('inventory_id', $inventory->id)->exists();
                if (!$exists) {
                    $order->items()->create([
                        'inventory_id' => $inventory->id,
                        'quantity' => $item['quantity'],
                        'price' => $price,
                        'total_price' => $price * $item['quantity'],
                        'user_id' => $order->user_id,
                        'currency_code' => $order->currency_code,
                    ]);
                }
            }

            // Tính tổng giá sản phẩm
            $order->total_price = $order->items->sum(fn($item) => $item->price * $item->quantity);

            // Thêm phí ship vào total_price
            $shippingFee = 16000;
            $order->total_price += $shippingFee;

            // Áp coupon nếu có
            if (!empty($data['coupon_code'])) {
                $coupon = Coupon::where('code', $data['coupon_code'])->first();
                if ($coupon) {
                    if ($order->usedDiscounts()->where('coupon_id', $coupon->id)->exists()) {
                        throw new \Exception('Coupon đã được sử dụng cho đơn hàng này');
                    }

                    $discountAmount = $coupon->discount_type === DiscountTypeEnum::PERCENTAGE->value
                        ? $order->total_price * ($coupon->discount_value / 100)
                        : $coupon->discount_value;

                    $order->discounts()->create([
                        'discountable_id'   => $coupon->id,
                        'discountable_type' => Coupon::class,
                        'discount_value'    => $discountAmount,
                        'discount_type'     => $coupon->discount_type ?? DiscountTypeEnum::FIXED->value,
                    ]);

                    $order->usedDiscounts()->create([
                        'user_id'   => $order->user_id,
                        'coupon_id' => $coupon->id,
                        'order_id'  => $order->id,
                        'used_at'   => now(),
                    ]);

                    // Grand total = tổng giá sản phẩm + ship - coupon
                    $order->grand_total = max(0, $order->total_price - $discountAmount);
                } else {
                    $order->grand_total = $order->total_price;
                }
            } else {
                $order->grand_total = $order->total_price;
            }

            $order->save();

            return $order->fresh();
        });
    }

    public function create(array $attributes = [])
    {
        $userId = data_get($attributes, 'user_id');
        $paymentOptionId = data_get($attributes, 'payment_option_id');
        $shippingOptionId = data_get($attributes, 'shipping_option_id');

        /** @var PaymentOption */
        $paymentOption = $this->paymentOptionService->show($paymentOptionId);

        // dd($paymentOption);

        /** @var ShippingOption */
        $shippingOption = $this->shippingOptionService->show($shippingOptionId);

        /** @var User */
        $user = $this->userService->show($userId);

        return DB::transaction(function () use ($attributes, $user, $paymentOption) {
            $admin = auth('admin')->user();

            Log::info('=== BẮT ĐẦU TẠO ĐƠN HÀNG ===', [
                'admin_id' => $admin?->id,
                'attributes' => $attributes
            ]);

            $cartItems = data_get($attributes, 'cart_items', []);
            if (empty($cartItems)) {
                Log::error('Giỏ hàng rỗng');
                throw new \Exception('Giỏ hàng rỗng. Vui lòng thêm sản phẩm.');
            }

            // Kiểm tra đơn hàng trùng lặp
            $uuid = data_get($attributes, 'uuid');
            if ($uuid && Order::where('uuid', $uuid)->exists()) {
                Log::error('Đơn hàng với UUID đã tồn tại:', ['uuid' => $uuid]);
                throw new \Exception('Đơn hàng này đã được tạo trước đó.');
            }

            // Tính tổng giá
            $calculatedTotalPrice = 0;
            foreach ($cartItems as $item) {
                $inventory = Inventory::find($item['inventory_id']);
                if (!$inventory) {
                    Log::error('Sản phẩm không tồn tại', $item);
                    throw new \Exception('Sản phẩm không tồn tại: ' . $item['inventory_id']);
                }
                $calculatedTotalPrice += ($inventory->final_price ?? 0) * ($item['quantity'] ?? 0);
            }

            $totalPrice = data_get($attributes, 'total_price', $calculatedTotalPrice);

            // Lấy thông tin tỉnh/thành phố
            $province = Province::where('code', data_get($attributes, 'province_code'))->first();
            if (!$province) {
                throw new \Exception('Tỉnh/Thành phố không hợp lệ.');
            }

            $paymentOptionType = $paymentOption->type ?? null;

            $orderStatus = OrderStatusEnum::WAITING_FOR_PAYMENT;
            $paymentStatus = 'waiting_for_payment';

            if (PaymentOptionTypeEnum::isThirdParty($paymentOptionType)) {
                $orderStatus = OrderStatusEnum::PROCESSING;
                $paymentStatus = 'processing';
            }

            // Nếu là COD
            if (PaymentOptionTypeEnum::isNoneAmount($paymentOptionType)) {
                $orderStatus = OrderStatusEnum::WAITING_FOR_PAYMENT;
                $paymentStatus = 'waiting_for_payment';
            }

            $orderData = [
                'user_id' => $user->id,
                'order_channel' => json_encode([
                    'type' => data_get($attributes, 'order_channel.type'),
                    'reference_id' => data_get($attributes, 'order_channel.reference_id'),
                ]),
                'fullname' => data_get($attributes, 'fullname'),
                'email' => data_get($attributes, 'email'),
                'phone' => data_get($attributes, 'phone'),
                'company' => data_get($attributes, 'company'),
                'province_code' => data_get($attributes, 'province_code'),
                'district_code' => data_get($attributes, 'district_code'),
                'ward_code' => data_get($attributes, 'ward_code'),
                'address_line' => data_get($attributes, 'address_line'),
                'user_note' => data_get($attributes, 'user_note'),
                'admin_note' => data_get($attributes, 'admin_note'),
                'city_name' => $province->name,
                'shipping_option_id' => data_get($attributes, 'shipping_option_id'),
                'shipping_rate_id' => data_get($attributes, 'shipping_rate_id'),
                'payment_option_id' => data_get($attributes, 'payment_option_id'),
                'total_price' => $totalPrice,
                'grand_total' => $totalPrice,
                'order_status' => $orderStatus,
                'payment_status' => $paymentStatus,
                'created_by_type' => get_class($admin),
                'created_by_id' => $admin->id,
                'updated_by_type' => get_class($admin),
                'updated_by_id' => $admin->id,
                'order_code' => strtoupper(uniqid(dechex(random_int(10, 99)))),
                'uuid' => \Illuminate\Support\Str::uuid(),
                'currency_code' => 'VND',
                'total_item' => count($cartItems),
                'total_quantity' => collect($cartItems)->sum('quantity'),
            ];

            /**
             * data -> temp
             * DB::commit() temp -> main
             * DB::rollback() remove temp
             */

            $order = $this->orderRepository->create($orderData);

            event(new OrderCreated($order));

            if ($couponId = data_get($attributes, 'coupon_id')) {
                $coupon = Coupon::find($couponId);
                if ($coupon) {
                    $discountAmount = data_get($attributes, 'discount_amount', 0);

                    $order->discounts()->create([
                        'discountable_id'   => $coupon->id,
                        'discountable_type' => Coupon::class,
                        'discount_value'    => $discountAmount,
                    ]);

                    $coupon->usedDiscounts()->create([
                        'user_id'   => $order->user_id,
                        'order_id'  => $order->id,
                    ]);

                    $coupon->increment('used');
                }
            }


            // Deposit
            /** @var DepositTransaction */
            $deposit = $this->depositService->deposit(
                $user,
                $order->grand_total,
                $paymentOption,
                $user,
                array_merge($attributes, ['order_id' => $order->getKey()])
            );

            // dd($deposit);

            $order->payment_status = $this->parseDepositStatusToOrderPaymentStatus($deposit->status);
            $order->deposit_transaction_id = $deposit->getKey();
            $order->save();

            $order = $order->fresh();

            // Lưu order items
            foreach ($cartItems as $item) {
                $inventory = Inventory::findOrFail($item['inventory_id']);
                $price = $inventory->offer_price ?? $inventory->sale_price ?? $inventory->final_price;

                $order->items()->create([
                    'inventory_id' => $item['inventory_id'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total_price' => $price * $item['quantity'],
                    'user_id' => $order->user_id,
                    'currency_code' => $order->currency_code,
                ]);
            }

            return $order;
        });
    }

    public function createUser(array $attributes = [])
    {
        $userId = data_get($attributes, 'user_id');
        $paymentOptionId = data_get($attributes, 'payment_option_id');
        $shippingOptionId = data_get($attributes, 'shipping_option_id');

        /** @var PaymentOption */
        $paymentOption = $this->paymentOptionService->show($paymentOptionId);

        /** @var ShippingOption */
        $shippingOption = $this->shippingOptionService->show($shippingOptionId);

        /** @var User */
        $user = $this->userService->show($userId);

        return DB::transaction(function () use ($attributes, $user, $paymentOption) {
            $creator = $user; // người tạo là user

            Log::info('=== BẮT ĐẦU TẠO ĐƠN HÀNG ===', [
                'user_id' => $creator->id,
                'attributes' => $attributes
            ]);

            $cartItems = data_get($attributes, 'cart_items', []);
            if (empty($cartItems)) {
                Log::error('Giỏ hàng rỗng');
                throw new \Exception('Giỏ hàng rỗng. Vui lòng thêm sản phẩm.');
            }

            // Kiểm tra đơn hàng trùng lặp
            $uuid = data_get($attributes, 'uuid');
            if ($uuid && Order::where('uuid', $uuid)->exists()) {
                Log::error('Đơn hàng với UUID đã tồn tại:', ['uuid' => $uuid]);
                throw new \Exception('Đơn hàng này đã được tạo trước đó.');
            }

            // Tính tổng giá
            $calculatedTotalPrice = 0;
            foreach ($cartItems as $item) {
                $inventory = Inventory::find($item['inventory_id']);
                if (!$inventory) {
                    Log::error('Sản phẩm không tồn tại', $item);
                    throw new \Exception('Sản phẩm không tồn tại: ' . $item['inventory_id']);
                }
                $calculatedTotalPrice += ($inventory->final_price ?? 0) * ($item['quantity'] ?? 0);
            }

            $totalPrice = data_get($attributes, 'total_price', $calculatedTotalPrice);

            // Lấy thông tin tỉnh/thành phố
            $province = Province::where('code', data_get($attributes, 'province_code'))->first();
            if (!$province) {
                throw new \Exception('Tỉnh/Thành phố không hợp lệ.');
            }

            // Chuẩn bị dữ liệu order
            $orderData = [
                'user_id' => $user->id,
                'order_channel' => json_encode([
                    'type' => data_get($attributes, 'order_channel.type'),
                    'reference_id' => data_get($attributes, 'order_channel.reference_id'),
                ]),
                'fullname' => data_get($attributes, 'fullname'),
                'email' => data_get($attributes, 'email'),
                'phone' => data_get($attributes, 'phone'),
                'company' => data_get($attributes, 'company'),
                'province_code' => data_get($attributes, 'province_code'),
                'district_code' => data_get($attributes, 'district_code'),
                'ward_code' => data_get($attributes, 'ward_code'),
                'address_line' => data_get($attributes, 'address_line'),
                'user_note' => data_get($attributes, 'user_note'),
                'admin_note' => data_get($attributes, 'admin_note'),
                'city_name' => $province->name,
                'shipping_option_id' => data_get($attributes, 'shipping_option_id'),
                'shipping_rate_id' => data_get($attributes, 'shipping_rate_id'),
                'payment_option_id' => data_get($attributes, 'payment_option_id'),
                'total_price' => $totalPrice,
                'grand_total' => $totalPrice,
                'order_status' => OrderStatusEnum::WAITING_FOR_PAYMENT,
                'payment_status' => 'waiting_for_payment',
                'created_by_type' => get_class($creator),
                'created_by_id' => $creator->id,
                'updated_by_type' => get_class($creator),
                'updated_by_id' => $creator->id,
                'order_code' => strtoupper(uniqid(dechex(random_int(10, 99)))),
                'uuid' => \Illuminate\Support\Str::uuid(),
                'currency_code' => 'VND',
                'total_item' => count($cartItems),
                'total_quantity' => collect($cartItems)->sum('quantity'),
            ];

            $order = $this->orderRepository->create($orderData);

            if ($couponId = data_get($attributes, 'coupon_id')) {
                $coupon = Coupon::find($couponId);
                if ($coupon) {
                    $discountAmount = data_get($attributes, 'discount_amount', 0);

                    $order->update([
                        'coupon_id' => $coupon->id,
                        'discount_amount' => $discountAmount,
                        'grand_total' => $order->total_price - $discountAmount,
                    ]);

                    $order->discounts()->create([
                        'discountable_id'   => $coupon->id,
                        'discountable_type' => Coupon::class,
                        'discount_value'    => $discountAmount,
                    ]);

                    $coupon->usedDiscounts()->create([
                        'user_id'   => $order->user_id,
                        'order_id'  => $order->id,
                    ]);

                    $coupon->increment('used');
                }
            }

            // Deposit
            /** @var DepositTransaction */
            $deposit = $this->depositService->deposit(
                $user,
                $order->grand_total,
                $paymentOption,
                $user,
                array_merge($attributes, ['order_id' => $order->getKey()])
            );

            $order->payment_status = $this->parseDepositStatusToOrderPaymentStatus($deposit->status);
            $order->deposit_transaction_id = $deposit->getKey();
            $order->save();

            $order = $order->fresh();

            // Lưu order items
            foreach ($cartItems as $item) {
                $inventory = Inventory::findOrFail($item['inventory_id']);
                $price = $inventory->offer_price ?? $inventory->sale_price ?? $inventory->final_price;

                $order->items()->create([
                    'inventory_id' => $item['inventory_id'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total_price' => $price * $item['quantity'],
                    'user_id' => $order->user_id,
                    'currency_code' => $order->currency_code,
                ]);
            }

            return $order;
        });
    }

    public function parseDepositStatusToOrderPaymentStatus($depositStatus, $throwIfNotFound = true)
    {
        $mappers = [
            DepositStatusEnum::DECLINED => PaymentStatusEnum::DECLINED,
            DepositStatusEnum::PENDING  => PaymentStatusEnum::PENDING,
            DepositStatusEnum::WAIT_FOR_CONFIRMATION => PaymentStatusEnum::PENDING,
            DepositStatusEnum::APPROVED => PaymentStatusEnum::APPROVED,
            DepositStatusEnum::CANCELED => PaymentStatusEnum::CANCELED,
            DepositStatusEnum::FAILED   => PaymentStatusEnum::FAILED,
        ];

        $status = $mappers[$depositStatus] ?? null;

        return $status;
    }

    public function find($id)
    {
        return $this->orderRepository->find($id);
    }

    public function show($id)
    {
        return $this->orderRepository->findOrFail($id);
    }

    public function formatPrice($number, $suffix = '₫')
    {
        if ($number === null) {
            return '0' . $suffix;
        }

        return number_format($number, 0, ',', '.') . $suffix;
    }

    public function formatDatetime($datetime, $format = 'd/m/Y H:i:s')
    {
        if (!$datetime) {
            return '';
        }

        return \Carbon\Carbon::parse($datetime)->format($format);
    }

    public function updateStatus($order, string $status, array $extraData = [])
    {
        return DB::transaction(function () use ($order, $status, $extraData) {
            $admin = auth('admin')->user();

            $oldStatus = $order->order_status;

            switch ($status) {
                case 'processing':
                    $order->order_status = OrderStatusEnum::PROCESSING;
                    break;

                case 'delivery':
                    $order->order_status = OrderStatusEnum::DELIVERY;

                    if (isset($extraData['shipping_date'])) {
                        $order->shipping_date = $extraData['shipping_date'];
                    }
                    if (isset($extraData['delivery_date'])) {
                        $order->delivery_date = $extraData['delivery_date'];
                    }
                    break;

                case 'complete':
                    $order->order_status = OrderStatusEnum::COMPLETED;

                    if ($oldStatus != OrderStatusEnum::COMPLETED) {
                        foreach ($order->items as $item) {
                            $inventory = Inventory::find($item->inventory_id);
                            if ($inventory) {
                                $inventory->stock_quantity -= $item->quantity;
                                $inventory->sold_count += $item->quantity;
                                $inventory->save();
                            }
                        }
                    }
                    break;

                case 'refund':
                    $order->order_status = OrderStatusEnum::REFUNDED;
                    break;

                case 'cancel':
                    $order->order_status = OrderStatusEnum::CANCELED;
                    break;

                default:
                    throw new \InvalidArgumentException("Invalid status: $status");
            }

            $order->updated_by_type = get_class($admin);
            $order->updated_by_id = $admin->id;
            $order->save();

            return $order;
        });
    }


    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->orderRepository->findOrFail($id);


            $admin = auth('admin')->user();
            $attributes['updated_by_type'] = get_class($admin);
            $attributes['updated_by_id'] = $admin->id;

            // Cập nhật đơn hàng
            $order = $this->orderRepository->update($id, $attributes);

            // Nếu có cart_items, cập nhật hoặc tạo mới
            if (isset($attributes['cart_items'])) {
                // Xóa các mục cũ (tùy thuộc vào yêu cầu)
                $model->items()->delete();

                // Thêm các mục mới
                foreach ($attributes['cart_items'] as $item) {
                    $inventory = Inventory::findOrFail($item['inventory_id']);

                    $model->items()->create([
                        'inventory_id' => $item['inventory_id'],
                        'quantity' => $item['quantity'],
                        'price' => $inventory->final_price,
                    ]);
                }
            }

            Log::debug('Đơn hàng đã cập nhật:', ['order_id' => $id, 'attributes' => $attributes]);

            return $order;
        });
    }

    public function cancel($id)
    {
        return DB::transaction(function () use ($id) {
            $order = $this->orderRepository->findOrFail($id);

            $order->order_status = OrderStatusEnum::CANCELED;

            $user = auth('admin')->user() ?? auth('sanctum')->user();
            if ($user) {
                $order->updated_by_type = get_class($user);
                $order->updated_by_id = $user->id;
            }

            $order->save();

            return $order;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $order = $this->orderRepository->findOrFail($id);
            $order->items()->delete();
            return $this->orderRepository->delete($id);
        });
    }
}
