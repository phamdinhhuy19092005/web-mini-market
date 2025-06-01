@extends('backoffice.layouts.master')

@php
    $title = __('Setting Banners');

    $breadcrumbs = [
        [
            'label' => __('Interface'),
        ],
        [
            'label' => __('Setting Banners'),
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
                                    List Banner
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.banners.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                       Create banner
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
                                                <form action="{{ route('bo.web.banners.index') }}" method="GET" onsubmit="return true;">
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
                               <table class="k-datatable__table" style="display: block; min-height: 300px; border: 1px solid #f7f8fa; table-layout: fixed; width: 100%; box-sizing: border-box;">
                                    <thead class="k-datatable__head">
                                        <tr class="k-datatable__row" style="text-align: center; vertical-align: middle;">
                                            <th data-field="id" class="k-datatable__cell" style="width: 50px; padding: 10px;">
                                                <span>ID</span>
                                            </th>
                                            <th data-field="desktop_image" class="k-datatable__cell text-center" style="width: 100px; padding: 10px;">
                                                <span>Ảnh Desktop</span>
                                            </th>
                                            <th data-field="name" data-autohide-enabled="true" class="k-datatable__cell text-center" style="width: 150px; padding: 10px;">
                                                <span>Tên</span>
                                            </th>
                                            <th data-field="cta_label" class="k-datatable__cell text-center" style="width: 80px; padding: 10px;">
                                                <span>Nhãn CTA</span>
                                            </th>
                                            <th data-field="redirect_url" class="k-datatable__cell text-center" style="width: 100px; padding: 10px;">
                                                <span>URL</span>
                                            </th>
                                            <th data-field="order" class="k-datatable__cell text-center" style="width: 60px; padding: 10px;">
                                                <span>Thứ tự</span>
                                            </th>
                                            <th data-field="status" class="k-datatable__cell text-center" style="width: 100px; padding: 10px;">
                                                <span>Trạng thái</span>
                                            </th>
                                            <th data-field="color" class="k-datatable__cell text-center" style="width: 100px; padding: 10px;">
                                                <span>Màu sắc</span>
                                            </th>
                                            <th data-field="start_at" class="k-datatable__cell text-center" style="width: 85px; padding: 10px;">
                                                <span>Ngày bắt đầu</span>
                                            </th>
                                            <th data-field="end_at" class="k-datatable__cell text-center" style="width: 85px; padding: 10px;">
                                                <span>Ngày kết thúc</span>
                                            </th>
                                            <th data-field="created_at" class="k-datatable__cell text-center" style="width: 120px; padding: 10px;">
                                                <span>Ngày tạo</span>
                                            </th>
                                            <th data-field="updated_at" class="k-datatable__cell text-center" style="width: 120px; padding: 10px;">
                                                <span>Ngày cập nhật</span>
                                            </th>
                                            <th data-field="actions" data-autohide-disabled="false" class="k-datatable__cell--left k-datatable__cell" style="width: 100px; padding: 10px;">
                                                <span>Hành động</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="k-datatable__body" style="padding: 0;">
                                        @foreach ($banners as $type => $bannerGroup)
                                            <tr class="group" style="background-color: #F7F8FA; display: block; width: 100%;">
                                                <td style="padding: 10px 15px;" class="group-value" colspan="13">
                                                    {{ $type == 1 ? 'Home Banner' : ($type == 2 ? 'In-App 100%' : 'In-App 50%') }}
                                                </td>
                                            </tr>

                                            @foreach ($bannerGroup as $banner)
                                                <tr role="row" class="odd" style="text-align: center; vertical-align: middle;">
                                                    <td class="id sorting_1" tabindex="0" style="width: 50px; padding: 10px;">{{ $banner->id }}</td>
                                                    <td class="desktop_image" style="width: 100px; padding: 10px;">
                                                        @if ($banner->desktop_image)
                                                            <img src="{{ asset($banner->desktop_image) }}" alt="Banner Image" width="100" height="150">
                                                        @else
                                                            <span>Không có ảnh</span>
                                                        @endif
                                                    </td>
                                                    <td class="name" style="width: 150px; padding: 10px;">{{ $banner->name ?? 'N/A' }}</td>
                                                    <td class="cta_label" style="width: 80px; padding: 10px;">{{ $banner->cta_label ?? 'N/A' }}</td>
                                                    <td class="redirect_url" style="width: 100px; padding: 10px; word-break: break-word;">
                                                        @if ($banner->redirect_url)
                                                            <a href="{{ $banner->redirect_url }}" style="text-decoration: none; color: #007bff;" target="_blank">Link</a>
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="order" style="width: 60px; padding: 10px;">{{ $banner->order ?? '0' }}</td>
                                                    <td class="status" style="width: 100px; padding: 10px;">
                                                        <span class="k-badge k-badge--{{ $banner->status ? 'success' : 'danger' }} k-badge--inline k-badge--pill">
                                                            {{ $banner->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td class="color" style="width: 100px; padding: 10px;">
                                                        @if ($banner->color)
                                                            <div class="d-flex align-items-center flex-column justify-content-center">
                                                                <div style="background: {{ $banner->color }}; width: 40px; height: 40px; border: 1px solid #ddd;"></div>
                                                                <span class="mt-2">{{ $banner->color }}</span>
                                                            </div>
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="start_at" style="width: 85px; padding: 10px;">
                                                        @if ($banner->start_at)
                                                            {{ \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d H:i:s') }}
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="end_at" style="width: 85px; padding: 10px;">
                                                        @if ($banner->end_at)
                                                            {{ \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d H:i:s') }}
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="created_at" style="width: 120px; padding: 10px;">
                                                        {{ \Carbon\Carbon::parse($banner->created_at)->format('Y-m-d H:i:s') }}
                                                    </td>
                                                    <td class="updated_at" style="width: 120px; padding: 10px;">
                                                        {{ \Carbon\Carbon::parse($banner->updated_at)->format('Y-m-d H:i:s') }}
                                                    </td>
                                                    <td class="actions" style="width: 100px; padding: 10px;">
                                                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_update"
                                                        data-action="update"
                                                        data-toggle="tooltip"
                                                        data-original-title="Update"
                                                        href="{{ route('bo.web.banners.edit', $banner->id) }}"
                                                        style="margin-right: 5px;">
                                                            <i class="la flaticon-edit-1"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_delete"
                                                        data-action="delete"
                                                        data-toggle="tooltip"
                                                        data-original-title="Delete"
                                                        href="{{ route('bo.web.banners.destroy', $banner->id) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?');">
                                                            <i class="la flaticon2-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="k-datatable__pager k-datatable--paging-loaded clearfix">

                                    {{ $bannersPaginated->links('vendor.pagination.custom-k-datatable') }}

                                    <div class="k-datatable__pager-info">
                                        <div class="dropdown bootstrap-select k-datatable__pager-size" style="width: 70px;">
                                            <select class="selectpicker k-datatable__pager-size"
                                                    title="Select page size"
                                                    data-width="70px"
                                                    onchange="window.location.href='{{ $bannersPaginated->url(1) }}&per_page='+this.value">
                                                <option value="10" {{ $bannersPaginated->perPage() == 10 ? 'selected' : '' }}>10</option>
                                                <option value="20" {{ $bannersPaginated->perPage() == 20 ? 'selected' : '' }}>20</option>
                                                <option value="30" {{ $bannersPaginated->perPage() == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50" {{ $bannersPaginated->perPage() == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ $bannersPaginated->perPage() == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <span class="k-datatable__pager-detail">
                                            Showing {{ $bannersPaginated->firstItem() }} -
                                            {{ $bannersPaginated->lastItem() }} of {{ $bannersPaginated->total() }}
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
