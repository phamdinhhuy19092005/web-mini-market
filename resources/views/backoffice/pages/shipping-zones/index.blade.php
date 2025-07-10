@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý vùng vận chuyển');
    $breadcrumbs = [
        ['label' => __('Vận chuyển')],
        ['label' => __('Cài đặt vận chuyển')],
        ['label' => __('Quản lý vùng vận chuyển')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách vùng vận chuyển') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.shipping-zones.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo vùng vận chuyển') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_shipping_zones_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.shipping-zones.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                <th data-property="supported_countries" scope="col">{{ __('Quốc gia hỗ trợ') }}</th>
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