@extends('backoffice.layouts.master')

@php
    $title = __('Biến thể');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('Biến thể')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách biến thể') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.attribute-values.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo biến thể') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_attribute_values_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.attribute-values.index') }}" data-searching="true" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="value" scope="col">{{ __('Giá trị') }}</th>
                                <th data-property="order" scope="col">{{ __('Thứ tự') }}</th>
                                <th data-property="attribute_name" scope="col">{{ __('Thuộc tính') }}</th>
                                <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                <th data-property="created_at" scope="col">{{ __('Ngày tạo') }}</th>
                                <th data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
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

<script>
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

@component('backoffice.partials.datatable')@endcomponent
