@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý giỏ hàng');
    $breadcrumbs = [
        ['label' => __('Giỏ hàng')],
        ['label' => __('Quản lý giỏ hàng')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách giỏ hàng') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.carts.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo giỏ hàng') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_carts_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.carts.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="user_name" scope="col">{{ __('Người dùng') }}</th>
                                <th data-property="uuid" scope="col">{{ __('Mã giỏ hàng (UUID)') }}</th>
                                <th data-property="total_item" scope="col">{{ __('Số lượng sản phẩm') }}</th>
                                <th data-property="total_quantity" scope="col">{{ __('Tổng số lượng') }}</th>
                                <th data-property="total_price" scope="col">{{ __('Tổng giá trị') }}</th>
                                <th class="none" data-property="created_at" scope="col">{{ __('Ngày tạo') }}</th>
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
