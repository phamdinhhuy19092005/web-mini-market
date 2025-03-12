@extends('backoffice.layouts.master')

@php
    $title = __('Manage Category Groups');

    $breadcrumbs = [
        [
            'label' => __('Products'),
        ],
        [
            'label' => __('Categories'),
        ],
        [
            'label' => __('Manage Category Groups'),
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
                                    Manage Category Groups
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.category-groups.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                        Create new
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
                                                <form action="{{ route('bo.web.category-groups.index') }}" method="GET" onsubmit="return true;">
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
                                <table class="k-datatable__table" style="display: block; min-height: 300px;">
                                    <thead class="k-datatable__head">
                                        <tr class="k-datatable__row">
                                            <th data-field="id" class="k-datatable__cell" style="width: 40px;">
                                                <span>ID</span>
                                            </th>
                                            <th data-field="image" class="k-datatable__cell text-center" style="width: 100px;">
                                                <span>Hình ảnh</span>
                                            </th>
                                            <th data-field="name" data-autohide-enabled="true" class="k-datatable__cell text-center" style="width: 100px;">
                                                <span>Tên</span>
                                            </th>
                                            <th data-field="order" class="k-datatable__cell text-center" style="width: 50px;">
                                                <span>Thứ tự</span>
                                            </th>
                                            <th data-field="status" class="k-datatable__cell text-center" style="width: 80px;">
                                                <span>Trạng thái</span>
                                            </th>
                                            <th data-field="category" class="k-datatable__cell text-center" style="width: 300px;">
                                                <span>Danh mục</span>
                                            </th>
                                            <th data-field="created_date" class="k-datatable__cell text-center" style="width: 100px;">
                                                <span>Ngày tạo</span>
                                            </th>
                                            <th data-field="updated_date" class="k-datatable__cell text-center" style="width: 100px;">
                                                <span>Ngày cập nhật</span>
                                            </th>
                                            <th data-field="actions" data-autohide-disabled="false" class="k-datatable__cell--left k-datatable__cell" style="width: 80px;">
                                                <span>Hành động</span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="k-datatable__body" style="padding: 0;">
                                        @foreach ($categoryGroups as $category)
                                            <tr data-row="0" class="k-datatable__row" style="left: 0px;">
                                                <td class="k-datatable__cell--center k-datatable__cell k-datatable__cell--check"
                                                    data-field="id" style="width: 40px;">
                                                    <span>{{ $category->id }}</span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="image" style="width: 60px;">
                                                    <span>
                                                        <img src="{{$category->image}}" alt="" width="100" height="150">
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="name" style="width: 100px;">
                                                    <span>{{ $category->name }}</span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="order" style="width: 50px;">
                                                    <span>{{ $category->id }}</span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="status" style="width: 80px;">
                                                    <span>
                                                        <span class="k-badge {{ $category->status ? 'k-badge--success' : 'k-badge--danger' }} k-badge--inline k-badge--pill">
                                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="category" style="width: 300px;">
                                                    <span>
                                                        @forelse ($category->categories->take(5) as $cat)
                                                            <span class="mr-1 mt-1 mb-1 d-inline-block">
                                                                <span class="k-badge k-badge--brand k-badge--inline k-badge--outline k-badge--pill">
                                                                    {{ $cat->name ?? 'Danh mục không tên' }}
                                                                </span>
                                                            </span>
                                                        @empty
                                                            <span class=""></span>
                                                        @endforelse
                                                    </span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="created_date" style="width: 100px;">
                                                    <span>{{ $category->created_at }}</span>
                                                </td>
                                                <td class="k-datatable__cell" data-field="updated_date" style="width: 100px;">
                                                    <span>{{ $category->updated_at }}</span>
                                                </td>
                                                <td class="k-datatable__cell--left k-datatable__cell" data-field="actions"
                                                    data-autohide-disabled="false" style="width: 80px;">
                                                    <span style="overflow: visible; position: relative;">
                                                        <a href="{{ route('bo.web.category-groups.edit', $category->id) }}"
                                                            title="Edit details"
                                                            class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="la la-edit"></i>
                                                        </a>

                                                        <form action="{{ route('bo.web.category-groups.destroy', $category->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn-icon-md">
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

                                    {{ $categoryGroups->links('vendor.pagination.custom-k-datatable') }}

                                    <div class="k-datatable__pager-info">
                                        <div class="dropdown bootstrap-select k-datatable__pager-size"
                                            style="width: 70px;">
                                            <select class="selectpicker k-datatable__pager-size" title="Select page size"
                                                data-width="70px"
                                                onchange="window.location.href='{{ $categoryGroups->url(1) }}?query={{ request('query') }}&per_page='+this.value">
                                                <option value="10"
                                                    {{ $categoryGroups->perPage() == 10 ? 'selected' : '' }}>10</option>
                                                <option value="20"
                                                    {{ $categoryGroups->perPage() == 20 ? 'selected' : '' }}>20</option>
                                                <option value="30"
                                                    {{ $categoryGroups->perPage() == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50"
                                                    {{ $categoryGroups->perPage() == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100"
                                                    {{ $categoryGroups->perPage() == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <span class="k-datatable__pager-detail">
                                            Showing {{ $categoryGroups->firstItem() }} -
                                            {{ $categoryGroups->lastItem() }} of {{ $categoryGroups->total() }}
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
