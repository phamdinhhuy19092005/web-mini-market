@extends('backoffice.layouts.master')

@php
    $title = __('Cài đặt Banner');

    $breadcrumbs = [
        [
            'label' => __('Giao diện'),
        ],
        [
            'label' => __('Cài đặt Banner'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- begin:: Nội dung chính -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">

                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet k-portlet--mobile">
                        <div class="k-portlet__head k-portlet__head--lg">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">
                                    Danh sách Banner
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.banners.create') }}"
                                        class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                        Tạo Banner
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="k-portlet__body k-portlet__body--fit p-4">
                            <table id="table_banners_index" 
                                class="table table-striped table-bordered table-hover table-checkable datatable" 
                                data-request-url="{{ route('bo.api.banners.index') }}"
                                data-searching="true">
                                <thead>
                                    <tr>
                                        <th data-property="id">{{ __('ID') }}</th>
                                        <th data-orderable="false" data-property="desktop_image" data-render-callback="renderImageColumn">{{ __('Hình ảnh trên Desktop') }}</th>
                                        <th data-property="name">{{ __('Tên') }}</th>
                                        <th class="none" data-property="cta_label">{{ __('Nhãn CTA') }}</th>
                                        <th class="none" data-property="redirect_url">{{ __('URL') }}</th>
                                        <th data-property="order">{{ __('Thứ tự') }}</th>
                                        <th data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                                        <th data-property="start_at">{{ __('Ngày bắt đầu') }}</th>
                                        <th data-property="end_at">{{ __('Ngày kết thúc') }}</th>
                                        <th class="none" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                        <th class="none" data-property="updated_at">{{ __('Ngày cập nhật') }}</th>
                                        <th data-property="actions" class="datatable-action" data-render-callback="renderActions" aria-label="Hành động">{{ __('Hành động') }}</th>                                
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Nội dung chính -->
@endsection
@component('backoffice.partials.datatable') @endcomponent