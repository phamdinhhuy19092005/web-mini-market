@extends('backoffice.layouts.master')

@php
    $title = __('Administrator');

    $breadcrumbs = [
        [
            'label' => __(' Administration '),
        ],
        [
            'label' => __('Administrator'),
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
                                    List Admin
                                </h3>
                            </div>
                            <div class="k-portlet__head-toolbar">
                                <div class="k-portlet__head-toolbar-wrapper">
                                    <a href="{{ route('bo.web.admins.create') }}"
                                        class="btn btn-default btn-bold btn-upper btn-font-sm">
                                        <i class="flaticon2-add-1"></i>
                                       Create admin
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="k-portlet__body k-portlet__body--fit">
                            <table id="table_admins_index" data-searching="true" data-request-url="{{ route('bo.api.admins.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr>
                                        <th data-property="id">{{ __('ID') }}</th>
                                        <th data-orderable="false" data-property="name">{{ __('Name') }}</th>
                                        <th data-orderable="false" data-property="email">{{ __('E-mail') }}</th>
                                        <th data-orderable="false" data-property="created_at">{{ __('Date created') }}</th>
                                        <th data-orderable="false" data-property="updated_at">{{ __('Date updated') }}</th>
                                        <th class="datatable-action" data-property="actions">{{ __('Active') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>

        </div>
    </div>
    <!-- end:: Content Body -->
@endsection

@component('backoffice.partials.datatable') @endcomponent
