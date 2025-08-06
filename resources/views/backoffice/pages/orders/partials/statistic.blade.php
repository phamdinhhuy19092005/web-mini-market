@php
    use App\Enum\OrderStatusEnum;
@endphp

<div class="row">
    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-secondary p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::WAITING_FOR_PAYMENT }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Chờ thanh toán') }}</h4>
                    <small>{{ __('Đang chờ thanh toán') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::WAITING_FOR_PAYMENT }}" data-api="{{ route('bo.api.orders.statistic.order-status', 1) }}}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-warning p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::PAYMENT_ERROR }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Thanh toán lỗi') }}</h4>
                    <small>{{ __('Thanh toán lỗi tháng này') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::PAYMENT_ERROR }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::PAYMENT_ERROR) }}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-primary p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::PROCESSING }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Đang chờ xử lí') }}</h4>
                    <small>{{ __('Đang chờ xử lí trong tháng') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::PROCESSING }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::PROCESSING) }}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-primary p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::DELIVERY }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Đang vận chuyển') }}</h4>
                    <small>{{ __('Chờ giao hàng trong tháng') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::DELIVERY }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::DELIVERY) }}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-success p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::COMPLETED }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Đã hoàn thành') }}</h4>
                    <small>{{ __('Đã hoàn thành trong tháng') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::COMPLETED }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::COMPLETED) }}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-danger p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::CANCELED }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Đã hủy') }}</h4>
                    <small>{{ __('Đã hủy trong tháng') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::CANCELED }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::CANCELED) }}"></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 order-lg-1 order-xl-1">
        <div class="k-portlet k-portlet--height-fluid statistic text-light bg-danger p-4 pb-5 pt-5" style="cursor: pointer;" onclick="reloadTable({{ OrderStatusEnum::REFUNDED }})">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>{{ __('Đã hoàn tiền') }}</h4>
                    <small>{{ __('Đã hoàn tiền trong tháng') }}</small>
                </div>
                <div>
                    <h1 data-order-status="{{ OrderStatusEnum::REFUNDED }}" data-api="{{ route('bo.api.orders.statistic.order-status', OrderStatusEnum::REFUNDED) }}"></h1>
                </div>
            </div>
        </div>
    </div>
</div>
