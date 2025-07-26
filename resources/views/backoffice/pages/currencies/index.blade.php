@extends('backoffice.layouts.master')

@php
    $title = __('Tiền tệ');

    $breadcrumbs = [
        [
            'label' => __('Khu vực'),
        ],
        [
            'label' => __('Tiền tệ'),
        ],
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
                            <h3 class="k-portlet__head-title">Danh sách tiền tệ </h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_currencies_index"
                            data-searching="true"
                            data-request-url="{{ route('bo.api.currencies.index') }}"
                            class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-property="name">{{ __('Tên') }}</th>
                                    <th data-property="type_name">{{ __('Loại') }}</th>
                                    <th data-property="used_countries" data-render-callback="renderStatusColumn">{{ __('Quốc gia đã sử dụng') }}</th>
                                    <th data-property="code">{{ __('Code') }}</th>
                                    <th data-property="symbol">{{ __('Biểu tượng') }}</th>
                                    <th data-property="decimals">{{ __('Số thập phân') }}</th>
                                    <th data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
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
@component('backoffice.partials.datatable')
@endcomponent
