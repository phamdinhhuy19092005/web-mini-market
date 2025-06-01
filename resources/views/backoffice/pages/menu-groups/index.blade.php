@extends('backoffice.layouts.master')

@php
    $title = __('Menu Group');

    $breadcrumbs = [
        [
            'label' => __('Interface'),
        ],
        [
            'label' => __('Menu Group'),
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
                                    List Menu Group
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.menu-groups.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                        Create menu group
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
                                                <form action="{{ route('bo.web.menu-groups.index') }}" method="GET" onsubmit="return true;">
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
                                <div class="table-responsive">
                                    <table id="table_mennu_groups_index" data-searching="true" data-request-url="" class="table table-striped table-bordered table-hover table-checkable" role="grid" aria-describedby="table_mennu_groups_index_info">
                                        <thead>
                                            <tr role="row">
                                                <th data-property="id" class="id sorting_desc text-center" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending" aria-sort="descending">ID</th>
                                                <th data-property="name" class="name sorting" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="Tên: activate to sort column ascending">Tên</th>
                                                <th data-link="redirect_url" data-link-target="_blank" data-property="redirect_url" class="redirect_url sorting" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="Chuyển hướng URL: activate to sort column ascending">Chuyển hướng URL</th>
                                                <th data-property="order" class="order sorting text-center" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="Thứ tự: activate to sort column ascending">Thứ tự</th>
                                                <th data-orderable="false" data-badge="" data-name="status" data-property="status_name" class="status sorting_disabled text-center" rowspan="1" colspan="1" aria-label="Trạng thái">Trạng thái</th>
                                                <th data-orderable="false" data-badge="" data-name="display_on_frontend" data-property="display_on_frontend_name" class="display_on_frontend sorting_disabled text-center" rowspan="1" colspan="1" aria-label="Hiển thị FE">Hiển thị FE</th>
                                                <th data-property="created_at" class="created_at sorting text-center" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="Ngày tạo: activate to sort column ascending">Ngày tạo</th>
                                                <th data-property="updated_at" class="updated_at sorting text-center" tabindex="0" aria-controls="table_mennu_groups_index" rowspan="1" colspan="1" aria-label="Ngày cập nhật: activate to sort column ascending">Ngày cập nhật</th>
                                                <th class="datatable-action actions sorting_disabled text-center" data-property="actions" rowspan="1" colspan="1" aria-label="Hành động">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td class="id sorting_1 text-center" tabindex="0" colspan="1">8</td>
                                                <td class="name">Bài viết mới</td>
                                                <td class="redirect_url"><a href="https://uudam.vn/tin-tuc.html" target="_blank">https://uudam.vn/tin-tuc.html</a></td>
                                                <td class="order text-center">8</td>
                                                <td class="status text-center"><span class="badge badge-pill badge-success">Active</span></td>
                                                <td class="display_on_frontend text-center"><span class="badge badge-pill badge-success">Active</span></td>
                                                <td class="created_at text-center">2024-05-18 04:11:29</td>
                                                <td class="updated_at text-center">2024-05-23 16:00:09</td>
                                                <td class="actions" style="width: 100px; padding: 10px;">
                                                    <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_update" href="#" style="margin-right: 5px;">
                                                        <i class="la flaticon-edit-1"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_delete" data-action="delete" data-toggle="tooltip" data-original-title="Delete" href="http://127.0.0.1:8003/bo/banners/6">
                                                        <i class="la flaticon2-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="id sorting_1 text-center" tabindex="0">7</td>
                                                <td class="name">Đèn dầu</td>
                                                <td class="redirect_url"><a target="_blank"></a></td>
                                                <td class="order text-center">6</td>
                                                <td class="status text-center"><span class="badge badge-pill badge-secondary">Inactive</span></td>
                                                <td class="display_on_frontend text-center"><span class="badge badge-pill badge-secondary">Inactive</span></td>
                                                <td class="created_at text-center">2024-04-10 16:16:06</td>
                                                <td class="updated_at text-center">2024-04-10 16:16:34</td>
                                                <td class="actions" style="width: 100px; padding: 10px;">
                                                    <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_update" href="" style="margin-right: 5px;">
                                                        <i class="la flaticon-edit-1"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-clean btn-icon btn-icon-md action_type_delete" data-action="delete" data-toggle="tooltip" data-original-title="Delete" href="http://127.0.0.1:8003/bo/banners/6">
                                                        <i class="la flaticon2-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>



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
