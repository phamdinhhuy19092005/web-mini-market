@extends('backoffice.layouts.master')

@php
    $title = __('Đánh giá sản phẩm');
    $breadcrumbs = [
        ['label' => __('Hỗ trợ khách hàng')],
        ['label' => __('Đánh giá sản phẩm')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách đánh giá') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.website-reviews.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo đánh giá') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_website_reviews_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.website-reviews.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="user_id" scope="col">{{ __('Id người đăng ký') }}</th>
                                <th data-property="user.name" data-name="user_id" data-link="user.actions.update" data-link-target="_blank">{{ __('Người dùng') }}</th>
                                <th class="none" data-property="comment" scope="col">{{ __('Nội dung') }}</th>
                                <th data-property="rating" scope="col">{{ __('Số sao') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                <th data-property="created_at" scope="col">{{ __('Ngày đăng') }}</th>
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
