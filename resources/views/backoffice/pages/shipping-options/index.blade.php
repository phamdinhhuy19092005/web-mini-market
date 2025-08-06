@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý phương thức vận chuyển');
    $breadcrumbs = [
        ['label' => __('Vận chuyển')],
        ['label' => __('Cài đặt vận chuyển')],
        ['label' => __('Quản lý phương thức vận chuyển')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách phương thức vận chuyển') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.shipping-options.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo phương thức vận chuyển') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_shipping_options_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.shipping-options.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                <th data-property="delivery_takes" scope="col">{{ __('Thời gian giao') }}</th>
                                <th data-property="shipping_zone_id" scope="col">{{ __('Khu vực') }}</th>
                                <th data-property="type_name" scope="col">{{ __('Loại') }}</th>
                                <th data-property="minimum" scope="col">{{ __('Tối thiểu') }}</th>
                                <th data-property="maximum" scope="col">{{ __('Tối đa') }}</th>
                                <th data-property="rate" scope="col">{{ __('Giá') }}</th>
                                <th data-property="status" scope="col">{{ __('Trạng thái') }}</th>
                                <th data-property="created_at" data-orderable="false" scope="col">{{ __('Ngày tạo') }}</th>
                                <th data-property="updated_at" data-orderable="false" scope="col">{{ __('Ngày cập nhật') }}</th>
                                <th class="actions" data-orderable="false" scope="col" aria-label="Hành động">{{ __('Hành động') }}</th>
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