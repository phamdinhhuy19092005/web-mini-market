@extends('backoffice.layouts.master')

@php
    $title = __('Products');

    $breadcrumbs = [
        [
            'label' => __('Products'),
        ],
        [
            'label' => __('Categories'),
        ],
        [
            'label' => __('Product Management'),
        ],
    ];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent



@section('content_body')
    <!-- begin:: Content Body -->
    <div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">

        <div class="k-portlet">
            <div class="k-portlet__head">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Search</h3>
                </div>
            </div>
            <!--begin::Form-->
            <form class="k-form k-form--label-right" data-datatable="table_products_index" id="form_products_index" method="GET">
                <div class="k-portlet__body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Categories</label>
                            <div class="dropdown bootstrap-select show-tick form-control k_" data-original-title="" title="">
                                <select name="categories[]" title="-- Chọn danh mục --" class="form-control k_selectpicker" data-size="5" multiple="" required="" data-live-search="true" tabindex="-98">

                            </select>
                            <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn danh mục --">
                                <div class="filter-option">
                                    <div class="filter-option-inner">-- Chọn danh mục --</div>
                                </div>
                                <span class="bs-caret">
                                    <span class="caret"></span>
                                </span>
                            </button>
                            <div class="dropdown-menu ">
                                <div class="bs-searchbox">
                                    <input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search">
                                </div>
                                <div class="inner show" tabindex="-1">
                                    <ul class="dropdown-menu inner show"></ul>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-lg-4 form-group">
                            <label>Status</label>
                            <div class="dropdown bootstrap-select form-control k_" data-original-title="" title="">
                                <select name="status" class="form-control k_selectpicker" tabindex="-98">
                                    <option value="">-- Chọn trạng thái --</option>
                                </select>
                                <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn trạng thái --">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">-- Chọn trạng thái --</div>
                                    </div>
                                    <span class="bs-caret"><span class="caret"></span>
                                </span>
                            </button>
                            <div class="dropdown-menu ">
                                <div class="inner show" tabindex="-1">
                                    <ul class="dropdown-menu inner show"></ul>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-lg-4 form-group">
                            <label>Type</label>
                            <div class="dropdown bootstrap-select form-control k_" data-original-title="" title=""><select name="type" class="form-control k_selectpicker" tabindex="-98">
                                <option value="">-- Chọn loại --</option>

                                                    </select><button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn loại --"><div class="filter-option"><div class="filter-option-inner">-- Chọn loại --</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__foot">
                    <div class="k-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" name="order_status" value="">

                                <button type="submit" class="btn btn-primary" id="btnSearch">Search</button>
                                <button type="reset" class="btn btn-secondary" onclick="setFilterParams()">Refresh</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <div class="row">
            <div class="col-md">

                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet k-portlet--mobile">
                        <div class="k-portlet__head k-portlet__head--lg">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">
                                   Product Management
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.categories.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                        Create new
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="k-portlet__body">

                            <!--begin: Search Form -->
                            <div class="k-form k-fork--label-right k-margin-t-20 k-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 k-margin-b-20-tablet-and-mobile">
                                                <div class="k-input-icon k-input-icon--left">
                                                    <input type="text" class="form-control" placeholder="Search..."
                                                        id="generalSearch" fdprocessedid="9n22f">
                                                    <span class="k-input-icon__icon k-input-icon__icon--left">
                                                        <span><i class="la la-search"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Search Form -->
                        </div>
                        <div class="k-portlet__body k-portlet__body--fit">

                            <!--begin: Datatable -->
                            <div class="k_datatable k-datatable k-datatable--default k-datatable--brand k-datatable--error k-datatable--loaded"
                                id="auto_column_hide">
                                <table class="k-datatable__table"
                                    style="display: block; min-height: 300px; border: 1px solid #f7f8fa;">
                                    <thead class="k-datatable__head">
                                        <tr class="k-datatable__row" role="row">
                                            <th data-property="id" class="k-datatable__cell id sorting_desc" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 13.25px;" aria-label="ID: activate to sort column ascending" aria-sort="descending">
                                                <span style="width: 13.45px;">ID</span>
                                            </th>
                                            <th data-property="name" class="k-datatable__cell name sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 60.25px;" aria-label="Tên: activate to sort column ascending" data-autohide-enabled="true">
                                                <span style="width: 52.45px;">Tên</span>
                                            </th>
                                            <th data-property="primary_image" class="k-datatable__cell primary_image sorting_disabled" data-orderable="false" data-render-callback="renderCallbackPrimaryImage" rowspan="1" colspan="1" style="width: 80.5px;" aria-label="Hình ảnh">
                                                <span style="width: 80.7px;">Hình ảnh</span>
                                            </th>
                                            <th data-property="status_name" class="k-datatable__cell status sorting_disabled" data-orderable="false" data-badge="" data-name="status" rowspan="1" colspan="1" style="width: 51.5px;" aria-label="Trạng thái">
                                                <span style="width: 60px;">Trạng thái</span>
                                            </th>
                                            <th data-property="type_name" class="k-datatable__cell type sorting" data-name="type" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 29.25px;" aria-label="Loại: activate to sort column ascending">
                                                <span style="width: 31.45px;">Loại</span>
                                            </th>
                                            <th data-property="code" class="k-datatable__cell code sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 65.25px;" aria-label="SKU: activate to sort column ascending">
                                                <span style="width: 50px;">SKU</span>
                                            </th>
                                            <th data-property="slug" class="k-datatable__cell slug sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 62.25px;" aria-label="Đường dẫn: activate to sort column ascending">
                                                <span style="width: 62.25px;">Đường dẫn</span>
                                            </th>
                                            <th data-property="branch" class="k-datatable__cell branch sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 49.25px;" aria-label="Thương hiệu: activate to sort column ascending">
                                                <span style="width: 49.25px;">Thương hiệu</span>
                                            </th>
                                            <th data-property="categories" class="k-datatable__cell categories sorting_disabled" data-orderable="false" data-render-callback="renderCallbackCategories" rowspan="1" colspan="1" style="width: 35.5px;" aria-label="Danh mục">
                                                <span style="width: 150px;">Nhóm danh mục</span>
                                            </th>
                                            <th data-property="created_by.name" class="k-datatable__cell created_by.name sorting_disabled" data-orderable="false" rowspan="1" colspan="1" style="width: 38.5px;" aria-label="Người tạo">
                                                <span style="width: 38.5px;">Người tạo</span>
                                            </th>
                                            <th data-property="updated_by.name" class="k-datatable__cell updated_by.name sorting_disabled" data-orderable="false" rowspan="1" colspan="1" style="width: 39.5px;" aria-label="Người cập nhật">
                                                <span style="width: 39.5px;">Người cập nhật</span>
                                            </th>
                                            <th data-property="created_at" class="k-datatable__cell created_at sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Ngày tạo: activate to sort column ascending">
                                                <span style="width: 73px;">Ngày tạo</span>
                                            </th>
                                            <th data-property="updated_at" class="k-datatable__cell updated_at sorting" tabindex="0" aria-controls="table_categories_index" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Ngày cập nhật: activate to sort column ascending">
                                                <span style="width: 73px;">Ngày cập nhật</span>
                                            </th>
                                            <th data-property="actions" class="k-datatable__cell datatable-action actions sorting_disabled" data-orderable="false" data-autohide-disabled="false" rowspan="1" colspan="1" style="width: 34.5px;" aria-label="Hành động">
                                                <span style="width: 64.45px;">Hành động</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody class="k-datatable__body" style="padding: 0;">
                                        @foreach ($categories as $category)
                                            <tr data-row="0" class="k-datatable__row" style="left: 0px;">
                                                <td class="k-datatable__cell--center k-datatable__cell k-datatable__cell--check"
                                                    data-field="id">
                                                    <span
                                                        style="width: 13.45px; text-align: left;">{{ $category->id }}</span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="name">
                                                    <span style="width: 52.45px;">{{ $category->name }}</span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="image">
                                                    <span style="width: 80.7px;">
                                                        <img src="{{ asset('assets/img/' . $category->image) }}"
                                                            alt="">
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="order">
                                                    <span style="width: 31.45px;">{{ $category->id }}</span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="product_count">
                                                    <span style="width: 50px;">12</span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="category">
                                                    <span style="width: 150px;">
                                                        {{ $category->categoryGroup->name ?? 'Chưa có nhóm' }}
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="status">
                                                    <span style="width: 60px;">
                                                        <span
                                                            class="k-badge {{ $category->status ? 'k-badge--success' : 'k-badge--danger' }} k-badge--inline k-badge--pill">
                                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="created_date">
                                                    <span style="width: 73px;">{{ $category->created_at }}</span>
                                                </td>
                                                <td class="k-datatable__cell text-center" data-field="updated_date">
                                                    <span style="width: 73px;">{{ $category->updated_at }}</span>
                                                </td>
                                                <td class="k-datatable__cell--left k-datatable__cell text-center"
                                                    data-field="actions">
                                                    <span style="overflow: visible; position: relative; width: 64.45px;">
                                                        <a href="{{ route('bo.web.categories.edit', $category->id) }}"
                                                            title="Edit details"
                                                            class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="la la-edit"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('bo.web.categories.destroy', $category->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                                <i class="la la-trash"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>

                                {{-- <div class="k-datatable__pager k-datatable--paging-loaded clearfix">

                                    {{ $categories->links('vendor.pagination.custom-k-datatable') }}

                                    <div class="k-datatable__pager-info">
                                        <div class="dropdown bootstrap-select k-datatable__pager-size"
                                            style="width: 70px;">
                                            <select class="selectpicker k-datatable__pager-size" title="Select page size"
                                                data-width="70px"
                                                onchange="window.location.href='{{ $categories->url(1) }}&per_page='+this.value">
                                                <option value="10"
                                                    {{ $categories->perPage() == 10 ? 'selected' : '' }}>10</option>
                                                <option value="20"
                                                    {{ $categories->perPage() == 20 ? 'selected' : '' }}>20</option>
                                                <option value="30"
                                                    {{ $categories->perPage() == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50"
                                                    {{ $categories->perPage() == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100"
                                                    {{ $categories->perPage() == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <span class="k-datatable__pager-detail">
                                            Showing {{ $categories->firstItem() }} -
                                            {{ $categories->lastItem() }} of {{ $categories->total() }}
                                        </span>
                                    </div>
                                </div> --}}
                            </div>

                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

        </div>
    </div>
    <!-- end:: Content Body -->
@endsection
