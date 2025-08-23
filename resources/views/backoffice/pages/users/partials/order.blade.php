<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
        <div class="col-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Danh sách đơn hàng khách hàng') }}</h3>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                <table id="table_orders_user"
                        class="table table-striped table-bordered table-hover table-checkable datatable"
                    data-request-url="{{ route('bo.api.orders.user', ['userId' => $user->id]) }}"
                        data-searching="false"
                        role="grid">
                    <thead>
                        <tr>
                            <th data-property="id" scope="col">{{ __('ID') }}</th>
                            <th data-property="order_code">{{ __('Mã đơn hàng') }}</th>
                            <th class="none" data-property="total_item">{{ __('Tổng sản phẩm') }}</th>
                            <th data-property="total_quantity">{{ __('Tổng số lượng') }}</th>
                            <th data-property="total_price">{{ __('Tổng') }}</th>
                            <th data-property="order_status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                            <th class="none" data-property="created_at" scope="col">{{ __('Ngày tạo') }}</th>
                            <th class="none" data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
                            <th data-property="actions" class="datatable-action" data-render-callback="renderActions" aria-label="Hành động">{{ __('Hành động') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

