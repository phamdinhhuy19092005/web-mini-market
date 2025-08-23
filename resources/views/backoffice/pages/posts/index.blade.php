@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý bài viết');
    $breadcrumbs = [
        ['label' => __('Tiện ích')],
        ['label' => __('Bài viết')],
        ['label' => __('Quản lý bài viết')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách bài viết') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.posts.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo bài viết') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_posts_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.posts.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                <th data-property="slug" scope="col">{{ __('Đường dẫn') }}</th>
                                <th data-property="image" data-render-callback="renderImageColumn" scope="col">{{ __('Ảnh') }}</th>
                                <th class="none" data-property="order" scope="col">{{ __('Thứ tự') }}</th>
                                <th class="none" data-property="code" scope="col">{{ __('Mã') }}</th>
                                <th class="none" data-property="author" scope="col">{{ __('Tác giả') }}</th>
                                <th data-property="post_category_name" style="width: 15%" data-render-callback="renderCallbackCategoryGroups" scope="col">{{ __('Danh mục') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                <th data-property="post_at" scope="col">{{ __('Ngày đăng') }}</th>
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
