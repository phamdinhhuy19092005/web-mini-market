@extends('backoffice.layouts.master')

@php
    $title = __('Tuỳ chọn thanh toán');
    $breadcrumbs = [
        ['label' => __('Cài đặt thanh toán')],
        ['label' => __('Tuỳ chọn thanh toán')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">
                <div class="k-portlet k-portlet--mobile">
                    <div class="k-portlet__head k-portlet__head--lg">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Danh sách tuỳ chọn thanh toán</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.payment-options.create') }}"
                               class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Tạo Tuỳ chọn thanh toán
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_payment_options_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.payment-options.index') }}"
                               data-searching="true">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="logo" data-render-callback="renderImageColumn" scope="col">{{ __('Logo') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="type" scope="col">{{ __('Loại tùy chọn') }}</th>
                                    <th data-property="payment_provider_id" scope="col">{{ __('Nhà cung cấp') }}</th>
                                    <th data-property="currency_code" scope="col">{{ __('Tiền tệ') }}</th>
                                    <th data-property="order" scope="col">{{ __('Thứ tự') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                    <th data-orderable="false" data-property="created_at">Ngày tạo</th>
                                    <th data-orderable="false" data-property="updated_at">Ngày cập nhật</th>
                                    <th class="datatable-action" data-property="actions">{{ __('Hành động') }}</th>  
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
