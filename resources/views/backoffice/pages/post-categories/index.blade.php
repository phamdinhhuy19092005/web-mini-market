@extends('backoffice.layouts.master')

@php
    $title = 'Danh mục Bài viết';

    $breadcrumbs = [
        [
            'label' => 'Tiện ích',
        ],
        [
            'label' => 'Bài viết',
        ],
        [
            'label' => 'Danh mục Bài viết',
        ],
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
                            <h3 class="k-portlet__head-title">Danh sách Danh mục Bài viết</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.post-categories.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Tạo Danh mục Bài viết
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_post_categories_index" data-searching="true" data-request-url="{{ route('bo.api.post-categories.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">ID</th>
                                    <th data-orderable="false" data-property="name">Tên</th>
                                    <th data-orderable="false" data-property="slug">Slug</th>
                                    <th data-orderable="false" data-render-callback="renderImageColumn" data-property="image">Hình ảnh</th>
                                    <th data-orderable="false" data-property="order">Thứ tự</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                                    <th data-orderable="false" data-property="created_at">Ngày tạo</th>
                                    <th data-orderable="false" data-property="updated_at">Ngày cập nhật</th>
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
