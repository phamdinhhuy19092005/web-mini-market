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
                        <div class="k-portlet__body k-portlet__body--fit">
                            <table id="table_banners_index" data-searching="true" data-request-url="{{ route('bo.api.banners.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr>
                                        <th data-property="id">{{ __('ID') }}</th>
                                        <th data-orderable="false">{{ __('Desktop Image') }}</th>
                                        <th data-orderable="false" data-property="name">{{ __('Name') }}</th>
                                        <th data-orderable="false" data-property="cta_label">{{ __('Nhãn CTA') }}</th>
                                        <th data-orderable="false" data-property="redirect_url">{{ __('URL') }}</th>
                                         <th data-orderable="false" data-property="order">{{ __('Thứ tự') }}</th>
                                        <th data-orderable="false" data-property="color">{{ __('Màu sắc') }}</th>
                                        <th data-orderable="false" data-property="start_at">{{ __('Ngày bắt đầu') }}</th>
                                        <th data-orderable="false" data-property="end_at">{{ __('Ngày kết thúc') }}</th>
                                        <th data-orderable="false" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                        <th data-orderable="false" data-property="updated_at">{{ __('Ngày cập nhật') }}</th>
                                        <th class="datatable-action" data-property="actions">{{ __('Action') }}</th>
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
