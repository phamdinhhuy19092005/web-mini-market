@extends('backoffice.layouts.master')

@php
    $title = __('Management Categories');

    $breadcrumbs = [
        [
            'label' => __('Products'),
        ],
        [
            'label' => __('Categories'),
        ],
        [
            'label' => __('Management Categories'),
        ],
    ];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent



@section('content_body')
    <!-- begin:: Content Body -->
    <div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">

                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet k-portlet--mobile">
                        <div class="k-portlet__head k-portlet__head--lg">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">
                                    Management Categories
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.categories.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                        Tạo mới
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="k-portlet__body">
                            <div class="k-form k-fork--label-right k-margin-t-20 k-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 k-margin-b-20-tablet-and-mobile">
                                                <form action="{{ route('bo.web.categories.index') }}" method="GET" onsubmit="return true;">
                                                    <div class="k-input-icon k-input-icon--left">
                                                        <input type="text" name="query" class="form-control" placeholder="Search..." value="{{ request('query') }}">
                                                        <span class="k-input-icon__icon k-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="k-portlet__body k-portlet__body--fit">

                            <!--begin: Datatable -->
                            <div class="k_datatable k-datatable k-datatable--default k-datatable--brand k-datatable--error k-datatable--loaded"
                                id="auto_column_hide">
                                <table class="k-datatable__table"
                                    style="display: block; min-height: 300px; border: 1px solid #f7f8fa;">
                                    <thead class="k-datatable__head">
                                        <tr class="k-datatable__row">
                                            <th data-field="id" class="k-datatable__cell">
                                                <span style="width: 13.45px;">ID</span>
                                            </th>
                                            <th data-field="name" data-autohide-enabled="true"
                                                class="k-datatable__cell text-center">
                                                <span style="width: 52.45px;">Tên</span>
                                            </th>
                                            <th data-field="image" class="k-datatable__cell text-center">
                                                <span style="width: 80.7px;">Hình ảnh</span>
                                            </th>
                                            <th data-field="order" class="k-datatable__cell text-center">
                                                <span style="width: 31.45px;">Thứ tự</span>
                                            </th>
                                            <th data-field="order" class="k-datatable__cell text-center">
                                                <span style="width: 50px;">Số sản phẩm</span>
                                            </th>
                                            <th data-field="category" class="k-datatable__cell text-center">
                                                <span style="width: 150px;">Nhóm danh mục</span>
                                            </th>
                                            <th data-field="status" class="k-datatable__cell text-center">
                                                <span style="width: 60px;">Trạng thái</span>
                                            </th>
                                            <th data-field="created_date" class="k-datatable__cell text-center">
                                                <span style="width: 73px;">Ngày tạo</span>
                                            </th>
                                            <th data-field="updated_date" class="k-datatable__cell text-center">
                                                <span style="width: 73px;">Ngày cập nhật</span>
                                            </th>
                                            <th data-field="actions" data-autohide-disabled="false"
                                                class="k-datatable__cell--left k-datatable__cell">
                                                <span style="width: 64.45px;">Hành động</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="k-datatable__body" style="padding: 0;">
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
                                                    <span style="width: 100px;">
                                                        @if ($category->image && \Illuminate\Support\Facades\Storage::disk('category')->exists(str_replace(\Illuminate\Support\Facades\Storage::disk('category')->url(''), '', $category->image)))
                                                            <img src="{{ $category->image }}" alt="{{ $category->name ?? 'Category Image' }}" width="100" height="auto">
                                                        @else
                                                            <img src="{{ asset('images/placeholder.jpg') }}" alt="No Image" width="100" height="auto">
                                                        @endif
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
                                    </tbody>
                                </table>

                                <div class="k-datatable__pager k-datatable--paging-loaded clearfix">

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
                                </div>
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
