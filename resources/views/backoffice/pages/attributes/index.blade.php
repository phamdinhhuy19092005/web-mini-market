@extends('backoffice.layouts.master')

@php
    $title = __('Thuộc tính');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('Thuộc tính')],
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
                        <h3 class="k-portlet__head-title">{{ __('Danh sách thuộc tính') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.attributes.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo thuộc tính') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_attributes_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.attributes.index') }}" data-searching="true" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th data-property="id" scope="col">{{ __('ID') }}</th>
                                <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                <th data-property="order" scope="col">{{ __('Thứ tự') }}</th>
                                <th data-property="attribute_type_name" scope="col">{{ __('Loại') }}</th>
                                <th data-property="supported_categories_names" data-render-callback="renderCallbackCategories" scope="col">{{ __('Danh mục') }}</th>
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

<script>
    function renderCallbackCategories(data, type, full) {
        const count = data?.length || 0;

        if (! count) {
            return;
        }

        const categoriesBadge = data.map((category, index) => {
            return $('<span>', { class: `mr-1 mt-1 mb-1 d-inline-block` })
                    .append(`<span class="k-badge k-badge--brand k-badge--inline k-badge--outline k-badge--pill">${category.name}</span>`).prop('outerHTML');
        });

        const container = $('<div>', { class: 'category-see-more' }).append(categoriesBadge.join(''));

        return container.prop('outerHTML');
    }
</script>

@component('backoffice.partials.datatable')@endcomponent
