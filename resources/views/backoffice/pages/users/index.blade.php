@extends('backoffice.layouts.master')

@php
    $title = __('Danh sách khách hàng');
    $breadcrumbs = [
        ['label' => __('Danh sách khác hàng')],
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
                            <h3 class="k-portlet__head-title">{{ __('Danh sách khách hàng') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_users_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.users.index') }}"
                               data-searching="true"
                               role="grid">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="email" scope="col">{{ __('Email') }}</th>
                                    <th data-property="phone_number" scope="col">{{ __('SĐT') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn" scope="col">{{ __('Trạng thái') }}</th>
                                    <th data-property="access_channel_type_name" data-render-callback="" scope="col">{{ __('Kênh đăng nhập') }}</th>
                                    <th data-property="last_logged_in_at" scope="col">{{ __('Đăng nhập lần cuối') }}</th>
                                    <th data-property="created_at" scope="col">{{ __('Ngày tạo') }}</th>
                                    <th data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
                                    <th data-property="actions" class="datatable-action" data-render-callback="renderActions" aria-label="Hành động">{{ __('Hành động') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('backoffice.partials.datatable')@endcomponent
@endsection
