@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý sản phẩm');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('Sản phẩm')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách sản phẩm') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.products.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo sản phẩm') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_products_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.products.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id">{{ __('ID') }}</th>
                                <th data-property="name" style="width: 325px;">{{ __('Tên sản phẩm') }}</th>
                                <th class="none" data-property="slug">{{ __('Slug') }}</th>
                                <th data-property="primary_image" data-render-callback="renderImageColumn">{{ __('Ảnh đại diện') }}</th>
                                <th data-property="code">{{ __('Mã sản phẩm') }}</th>
                                <th data-property="brand.name" data-name="brand_id" data-link="brand.actions.update" data-link-target="_blank">{{ __('Thương hiệu') }}</th>
                                <th data-render-callback="renderStatusColumn" data-property="type_name">{{ __('Loại') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                                <th class="none" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                <th class="none" data-property="updated_at">{{ __('Ngày cập nhật') }}</th>
                                <th class="none" data-property="created_by.name" data-name="created_by_id">{{ __('Người tạo') }}</th>
                                <th class="none" data-property="updated_by.name" data-name="updated_by_id">{{ __('Người cập nhật') }}</th>
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
