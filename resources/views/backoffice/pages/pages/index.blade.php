@extends('backoffice.layouts.master')

@php
    $title = __('Danh sách trang');

    $breadcrumbs = [
        [
            'label' => __('Tiện ích'),
        ],
        [
            'label' => __('Danh sách trang'),
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
                            <h3 class="k-portlet__head-title">Danh sách trang</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.pages.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> 
                                Tạo trang
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_pages_index" data-searching="true" data-request-url="{{ route('bo.api.pages.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-property="name">{{ __('Tên') }}</th>
                                    <th data-property="slug">{{ __('Slug') }}</th>
                                    <th data-property="title">{{ __('Tiêu đề') }}</th>
                                    <th data-property="order">{{ __('Thứ tự') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                                    <th data-orderable="false" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                    <th data-orderable="false" data-property="created_at">{{ __('Ngày cập nhật') }}</th>
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

    @component('backoffice.partials.datatable')
    @endcomponent
@endsection
