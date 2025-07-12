@extends('backoffice.layouts.master')

@php
    $title = __('Danh sách quản trị viên');
    $breadcrumbs = [
        ['label' => __('Quản trị')],
        ['label' => __('Quản trị viên')],
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
                            <h3 class="k-portlet__head-title">{{ __('Danh sách quản trị viên') }}</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-toolbar-wrapper">
                                <a href="{{ route('bo.web.admins.create') }}"
                                   class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                    <i class="flaticon2-add-1"></i>
                                    {{ __('Tạo quản trị viên') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_admins_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.admins.index') }}"
                               data-searching="true"
                               role="grid">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên') }}</th>
                                    <th data-property="email" scope="col">{{ __('Email') }}</th>
                                    <th data-property="created_at" scope="col">{{ __('Ngày tạo') }}</th>
                                    <th data-property="updated_at" scope="col">{{ __('Ngày cập nhật') }}</th>
                                    <th class="datatable-action" data-orderable="false" scope="col" aria-label="Hành động">{{ __('Hành động') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @component('backoffice.partials.datatable')
    @endcomponent
@endsection