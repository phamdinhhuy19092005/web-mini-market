@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý Danh mục');
    $breadcrumbs = [
        ['label' => __('Sản phẩm')],
        ['label' => __('Danh mục')],
        ['label' => __('Quản lý Danh mục')],
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
                            <h3 class="k-portlet__head-title">Danh sách Danh mục</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.categories.create') }}"
                               class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Tạo Danh mục
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_categories_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.categories.index') }}"
                               data-searching="true">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="image" data-orderable="false" data-render-callback="renderImageColumn" scope="col">{{ __('Hình ảnh') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="slug" scope="col">{{ __('Slug') }}</th>
                                    <th data-property="category_group_name" data-render-callback="renderCallbackCategoryGroups" scope="col">{{ __('Nhóm danh mục') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                    <th class="datatable-action" data-property="actions" data-render-callback="renderActions">{{ __('Hành động') }}</th>  
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
