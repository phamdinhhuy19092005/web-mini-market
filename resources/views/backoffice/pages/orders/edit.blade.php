@extends('backoffice.layouts.master')

@php
    $title = __('Chi tiết đơn hàng');
    $breadcrumbs = [
        ['label' => __('Quản lý đơn hàng')],
        ['label' => __('Chi tiết đơn hàng')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@php
    use App\Enum\OrderStatusEnum;

    $orderStatusBadge = 'badge-secondary';

    switch ($order->order_status) {
        case OrderStatusEnum::DECLINED:
        case OrderStatusEnum::PAYMENT_ERROR:
        case OrderStatusEnum::CANCELED:
            $orderStatusBadge = 'badge-danger';
            break;
        case OrderStatusEnum::REFUNDED:
            $orderStatusBadge = 'badge-secondary';
            break;
        case OrderStatusEnum::WAITING_FOR_PAYMENT:
        case OrderStatusEnum::DELIVERY:
            $orderStatusBadge = 'badge-warning';
            break;
        case OrderStatusEnum::PROCESSING:
            $orderStatusBadge = 'badge-info';
            break;
        case OrderStatusEnum::COMPLETED:
            $orderStatusBadge = 'badge-success';
            break;
        default:
            break;
    };
@endphp


@section('content_body')
    <div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-6">
                <div class="pt-2 pb-4 d-flex align-items-center">
                    <h3 class="m-0 b-0">#{{ $order->order_code }}</h3>
                    <span style="padding: 0 10px;">|</span>
                    <span class="badge {{ $orderStatusBadge }}">{{ $order->order_status_name }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btns d-flex justify-content-end">
                    @can('orders.manage')
                    <button type="submit" data-btn-change-order-status="update-to-delivery" class="btn btn-secondary ml-2" data-route="{{ route('bo.api.orders.delivery', $order->id) }}" {{ !$order->canDelivery() ? 'disabled' : '' }}>{{ __('VẬN CHUYỂN') }}</button>
                    <button type="submit" data-btn-change-order-status="update-to-complete" class="btn btn-success ml-2" data-route="{{ route('bo.api.orders.complete', $order->id) }}" {{ !$order->canComplete() ? 'disabled' : '' }}>{{ __('HOÀN THÀNH') }}</button>
                    <button type="submit" data-btn-change-order-status="update-to-refund" class="btn btn-warning ml-2" data-route="{{ route('bo.api.orders.refund', $order->id) }}" {{ !$order->canRefund() ? 'disabled' : '' }}>{{ __('HOÀN TIỀN') }}</button>
                    <button type="submit" data-btn-change-order-status="update-to-cancel" class="btn btn-danger ml-2" data-route="{{ route('bo.api.orders.cancel', $order->id) }}" {{ !$order->canCancel() ? 'disabled' : '' }}>{{ __('HỦY ĐƠN') }}</button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Thông tin khách hàng') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="form-group">
                            <label for=""><b>{{ __('Tên khách hàng') }}</b></label>
                            <a href="{{ route('bo.web.users.edit', $order->user_id) }}" target="_blank" class="d-block">
                                <span>{{ $order->fullname }}</span>
                            </a>
                        </div>

                        <div class="form-group">
                            <label for=""><b>{{ __('Địa chỉ giao hàng') }}</b></label>
                            <div class="address-detail">
                                <div>{{ $order->fullname ?? 'N/A' }} - {{ $order->phone ?? 'N/A' }} - {{ $order->email ?? 'N/A' }}</div>
                                <div class="address-detail-content copy-text-click" data-copy-reference=".address-detail-content">
                                    {{ $order->full_address }}
                                </div>
                                <div>
                                    <a href="https://www.google.com/maps/search/{{ $order->full_address }}" target="_blank" class="d-inline-block btn btn-secondary btn-sm mt-2">{{ __('Xem google map') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                <i class="la la-money mr-1" style="font-size: 23px; display: inline-block; transform: translateY(2px);"></i>
                                <span>{{ $order->payment_status_name }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="alert alert-outline-accent fade show p-3" role="alert">
                            <div class="d-flex justify-content-between w-100">
                                <div style="color: #3d4465;">Khách phải trả: <b>{{ $order->getGrandTotalFormattedAttribute() }}</b></div>
                                <div style="color: #3d4465;">Đã thanh toán: 0</div>
                                <div style="color: #3d4465;">Còn phải trả: <b class="text-danger">{{ $order->getGrandTotalFormattedAttribute() }}</b></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>{{ __('Hình thức thanh toán') }}</b></label>
                                    <div>
                                        <img class="p-1" style="border: 1px solid #ccc; border-radius: 7px;" src="{{ data_get($order->paymentOption, ['logo']) }}" alt="{{ data_get($order->paymentOption, ['name']) }}" width="40" height="40">
                                        <span>{{ data_get($order->paymentOption, ['name']) }}</span>
                                    </div>
                                </div>
                            </div>

                            @if (data_get($order->paymentOption, ['expanded_content']))
                            <div class="col-md-6">
                                <div class="form-group order-transfer-content">
                                    <label for=""><b>{{ __('Thông tin thanh toán') }}</b></label>
                                    @php
                                    $orderTransferContent = implode('', [
                                        'UDBO',
                                        data_get($order, 'id'),
                                    ]);

                                    $expandedContent = str_replace('${order_transfer_content}', $orderTransferContent, data_get($order->paymentOption, ['expanded_content']));
                                    @endphp

                                    <p class="p-0 m-0">{!! nl2br($expandedContent) !!}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                <i class="flaticon-truck mr-1" style="font-size: 23px; display: inline-block; transform: translateY(2px);"></i>
                                <span>{{ __('Đóng gói và giao hàng') }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="d-block mr-2" style="width: 10px; height: 10px; border-radius: 50%; background-color: #5867dd;"></span>
                                <div>
                                    <span class="text-primary shipping-referece-id">{{ data_get($order->latestUserOrderShippingHistory, ['reference_id']) ?? 'N/A' }}</span>
                                    <span class="copy-text-click ml-2" data-copy-reference=".shipping-referece-id" title="{{ __('Sao chép') }}" style="font-size: 17px; display: inline-block; transform: translateY(2px);">
                                        <i class="flaticon2-copy"></i>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-elevate btn-circle btn-icon" data-toggle="modal" data-target="#process_shipping_order">
                                    <i class="la la-pencil"></i>
                                </button>
                            </div>
                        </div>
                        <div class="detail-information row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">Vận chuyển bởi</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">{{ data_get($order->latestUserOrderShippingHistory, ['shippingProvider', 'name']) }}</div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">P.T vận chuyển</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">{{ optional($order->shippingOption)->name ?? 'N/A' }}</div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">Khối lượng</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">{{ $order->total_weight ?? 'N/A' }} <small>(gam)</small> -> {{ (float) $order->total_weight / 1000 }} <small>(kg)</small></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">Người trả phí</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">Shop</div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">Phí ước tính</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">
                                        <b class="text-danger">
                                            {{ $orderService->formatPrice(data_get($order->latestUserOrderShippingHistory, ['estimated_transport_fee'])) }}
                                        </b>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div style="flex: 0 0 30%;" class="pt-2 pb-2">Phí trả ĐVVC</div>
                                    <span class="pt-2 pb-2 mr-2">:</span>
                                    <div style="flex: 1;" class="pt-2 bp-2">
                                       <b class="text-danger">
                                            {{ $order->transport_fee ? $orderService->formatPrice($order->transport_fee) : 'N/A' }}
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Thông tin đơn hàng') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">Chính sách giá</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            <div style="flex: 1;" class="pt-2 bp-2">Giá bán lẻ</div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">Bán tại</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            <div style="flex: 1;" class="pt-2 bp-2">Chi nhánh mặc định</div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">NV lên đơn</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            <div style="flex: 1;" class="pt-2 bp-2">admin</div>
                        </div>

                       <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">Ngày bán</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            <div style="flex: 1;" class="pt-2 bp-2">
                                {{ $orderService->formatDatetime($order->created_at, 'd/m/Y H:i:s') }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">Kênh bán hàng</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            {{ $accessChannelTypeLables[data_get($order, 'order_channel.type')] ?? 'Không xác định' }}
                        </div>

                        <div class="d-flex justify-content-start">
                            <div style="flex: 0 0 40%;" class="pt-2 pb-2">Tham chiếu</div>
                            <span class="pt-2 pb-2 mr-2">:</span>
                            <div style="flex: 1;" class="pt-2 bp-2">{{ data_get($order, 'order_channel.reference_id') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Ghi chú') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="form-group">
                            <label for=""><b>{{ __('Khách hàng ghi chú') }}</b></label>
                            <p class="p-0 m-0">{{ $order->user_note ?? 'N/A' }}</p>
                        </div>

                        <div class="form-group">
                            <label for=""><b>{{ __('NV ghi chú') }}</b></label>
                            <p class="p-0 m-0">{{ $order->admin_note ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Thông tin sản phẩm') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <table id="table_order_items_index" data-searching="true" data-request-url="{{ route('bo.api.order-items.index', ['order_id' => $order->id]) }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-orderable="false" data-property="inventory.image" data-render-callback="renderImageColumn">{{ __('Ảnh') }}</th>
                                    <th data-link="inventory.edit" data-link-target="_blank" data-orderable="false" data-property="inventory.title" data-width="400">{{ __('Tên sản phẩm') }}</th>
                                    <th data-property="quantity">{{ __('Số lượng') }}</th>
                                    <th data-property="price">{{ __('Đơn giá') }}</th>
                                    <th data-property="total_price">{{ __('Thành tiền') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush

@component('backoffice.partials.datatable')@endcomponent

