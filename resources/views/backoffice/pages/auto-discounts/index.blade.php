@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý mã giảm giá tự động');
    $breadcrumbs = [
        ['label' => __('Mã giảm giá')],
        ['label' => __('Mã giảm giá tự động')],
        ['label' => __('Quản lý mã giảm giá tự động')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Danh sách mã giảm giá') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.auto-discounts.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo mã giảm giá tự động') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_auto_discounts_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.auto-discounts.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="code" scope="col">{{ __('Mã') }}</th>
                                <th data-property="discount_type_name" scope="col">{{ __('Loại ') }}</th>
                                <th data-property="discount_value" scope="col">{{ __('Giá trị giảm giá') }}</th>
                                <th data-property="usage_limit" scope="col">{{ __('Giới hạn sử dụng') }}</th>
                                <th data-property="used" scope="col">{{ __('Đã sử dụng') }}</th>
                                <th data-property="start_date" scope="col">{{ __('Ngày bắt đầu ') }}</th>
                                <th data-property="end_date" scope="col">{{ __('Ngày kết thúc') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                <th class="none" data-property="title" scope="col">{{ __('Tiêu đề') }}</th>
                                <th class="none" data-property="condition_type" scope="col">{{ __('Loại điều kiện') }}</th>
                                <th class="none" data-property="condition_value" scope="col">{{ __('Giá trị điều kiện') }}</th>
                                <th class="none" data-property="created_at" scope="col">{{ __('Ngày tạo ') }}</th>
                                <th class="none" data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
                                <th data-property="actions" class="datatable-action" data-render-callback="renderActions" aria-label="Hành động">{{ __('Hành động') }}</th>
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
