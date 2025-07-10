@extends('backoffice.layouts.master')

@php
    $title = __('Thương hiệu');
    $breadcrumbs = [
        ['label' => __('Quản lý kho sản phẩm')],
        ['label' => __('Thương hiệu')],
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
                            <h3 class="k-portlet__head-title">Danh sách Thương hiệu</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.brands.create') }}"
                               class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Tạo Thương Hiệu
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_brands_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.brands.index') }}"
                               data-searching="true">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="image" data-render-callback="renderImageColumn" data-orderable="false" scope="col">{{ __('Hình ảnh') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="order" scope="col">{{ __('Thứ tự') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
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
@endsection

@push('js_pages')
<script>
    function renderImageColumn(data, type, full, meta) {
        if (!data) return '';
        return `<img src="${data}" alt="Hình ảnh" style="height: 60px;">`;
    }
    function renderStatusColumn(data, type, full, meta) {
        if (!data) return '';
        let classMap = {
            'Active': 'k-badge--success',
            'Inactive': 'k-badge--danger',
            'Pending': 'k-badge--warning'
        };

        // Mặc định là success nếu không xác định
        let badgeClass = classMap[data] || 'k-badge--secondary';

        return `<span style="width:max-content" class="k-badge k-badge--inline k-badge--pill ${badgeClass}">${data}</span>`;
    }
</script>
@endpush

@component('backoffice.partials.datatable')
@endcomponent


