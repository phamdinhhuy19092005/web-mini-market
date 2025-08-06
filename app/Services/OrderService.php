<?php

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Inventory; // Thêm để lấy giá sản phẩm
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    protected OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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


    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $admin = auth('admin')->user();

            $cartItems = data_get($attributes, 'cart_items', []);
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $inventory = Inventory::find($item['inventory_id']);
                $totalPrice += ($inventory->final_price ?? 0) * $item['quantity'];
            }

            $province = Province::where('code', data_get($attributes, 'province_code'))->first();

            $orderData = [
                'user_id' => data_get($attributes, 'user_id'),
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
                'postal_code' => data_get($attributes, 'postal_code'),
                'city_name' => $province->name,
                'shipping_option_id' => data_get($attributes, 'shipping_option_id'),
                'shipping_rate_id' => data_get($attributes, 'shipping_rate_id'),
                'payment_option_id' => data_get($attributes, 'payment_option_id'),
                'total_price' => data_get($attributes, 'total_price'),
                'grand_total' => data_get($attributes, 'total_price'),
                'order_status' => 1,
                'created_by_type' => get_class($admin),
                'created_by_id' => $admin->id,
                'updated_by_type' => get_class($admin),
                'updated_by_id' => $admin->id,
                'order_code' => uniqid('ORD_'),
                'uuid' => \Illuminate\Support\Str::uuid(),
                'currency_code' => 'VND',
                'total_item' => count($cartItems),
                'total_quantity' => collect($cartItems)->sum('quantity'),
            ];

            Log::debug('Dữ liệu đơn hàng trước khi tạo:', $orderData);

            $order = $this->orderRepository->create($orderData);

            foreach ($cartItems as $item) {
                $inventory = Inventory::findOrFail($item['inventory_id']);
                $order->items()->create([
                    'inventory_id' => $item['inventory_id'],
                    'quantity' => $item['quantity'],
                    'price' => $inventory->final_price ?? 0,
                    'user_id' => $order->user_id,
                    'currency_code' => $order->currency_code,
                ]);
            }

            Log::debug('Đơn hàng đã tạo:', ['order_id' => $order->id, 'cart_items' => $cartItems]);

            return $order;
        });
    }


    public function find($id)
    {
        return $this->orderRepository->find($id);
    }

    public function show($id)
    {
        return $this->orderRepository->findOrFail($id);
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
            $order->order_status = 'canceled';
            $order->updated_by_type = get_class(auth('admin')->user());
            $order->updated_by_id = auth('admin')->id();
            $order->save();
            return $order;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $order = $this->orderRepository->findOrFail($id);
            $order->items()->delete(); // Xóa các mục liên quan
            return $this->orderRepository->delete($id);
        });
    }
}