@extends('backoffice.layouts.master')

@php
    $title = __('Giao dịch gửi tiền');
    $breadcrumbs = [
        ['label' => __('Thanh toán')],
        ['label' => __('Giao dịch gửi tiền')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

<?php
    use App\Enum\DepositStatusEnum;
?>

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Danh sách giao dịch') }}</h3>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_deposit_transactions_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.deposit-transactions.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="user_name" scope="col">{{ __('Người dùng') }}</th>
                                <th data-property="order_id" scope="col">{{ __('Đơn hàng') }}</th>
                                <th data-property="payment_option_id" scope="col">{{ __('Phương thức thanh toán') }}</th>
                                <th data-property="amount" scope="col">{{ __('Số tiền đã nạp') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                <th class="none" data-property="created_at" scope="col">{{ __('Ngày tạo ') }}</th>
                                <th class="none" data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@component('backoffice.partials.datatable')
@endcomponent

