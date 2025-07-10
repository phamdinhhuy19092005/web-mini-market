@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý Nhóm Danh mục');
    $breadcrumbs = [
        ['label' => __('Sản phẩm')],
        ['label' => __('Danh mục')],
        ['label' => __('Quản lý Nhóm Danh mục')],
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
                            <h3 class="k-portlet__head-title">Danh sách Nhóm Danh mục</h3>
                        </div>

                        @canAny(['category-groups.store'])
                            @can('category-groups.store')
                            <div class="k-portlet__head-toolbar">
                                <a href="{{ route('bo.web.category-groups.create') }}"
                                   class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                    <i class="flaticon2-add-1"></i> Tạo Nhóm Danh mục
                                </a>
                            </div>
                            @endcan
                        @endcan
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_category_groups_index" data-searching="true" data-request-url="{{ route('bo.api.category-groups.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="image" data-orderable="false" data-render-callback="renderCallbackPrimaryImage" scope="col">{{ __('Hình ảnh') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="slug" scope="col">{{ __('Slug') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                    <th data-orderable="false" data-property="categories" data-render-callback="renderCallbackCategories">{{ __('Danh mục') }}</th>
                                    <th class="actions" data-orderable="false" data-render-callback="" scope="col" aria-label="Hành động">{{ __('Hành động') }}</th>
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
    function renderCallbackPrimaryImage(data, type, full) {
        const image = $('<img>', {
            src: data,
            width: 40,
            height: 40,
        });

        return image.prop('outerHTML');
    }

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

@component('backoffice.partials.datatable')
@endcomponent
