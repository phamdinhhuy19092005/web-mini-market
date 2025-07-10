@extends('backoffice.layouts.master')

@php
    $title = __('Danh sách quốc gia');
    $breadcrumbs = [
        ['label' => __('Khu vực')],
        ['label' => __('Quốc gia')],
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
                            <h3 class="k-portlet__head-title">{{ __('Danh sách quốc gia') }}</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_countries_index"
                               class="table table-striped table-bordered table-hover table-checkable datatable"
                               data-request-url="{{ route('bo.api.countries.index') }}"
                               data-searching="true"
                               role="grid">
                            <thead>
                                <tr>
                                    <th data-property="id" scope="col">{{ __('ID') }}</th>
                                    <th data-property="name" scope="col">{{ __('Tên quốc gia') }}</th>
                                    <th data-property="iso3" scope="col">{{ __('Mã ISO3') }}</th>
                                    <th data-property="numeric" scope="col">{{ __('Mã số') }}</th>
                                    <th data-property="iso2" scope="col">{{ __('Mã ISO2') }}</th>
                                    <th data-property="status" scope="col">{{ __('Trạng thái') }}</th>
                                    <th data-property="phonecode" scope="col">{{ __('Mã điện thoại') }}</th>
                                    <th data-property="capital" scope="col">{{ __('Thủ đô') }}</th>
                                    <th data-property="currency" scope="col">{{ __('Tiền tệ') }}</th>
                                    <th data-property="currency_name" scope="col">{{ __('Tên tiền tệ') }}</th>
                                    <th data-property="tld" scope="col">{{ __('TLD') }}</th>
                                    <th data-property="native" scope="col">{{ __('Tên bản địa') }}</th>
                                    <th data-property="region" scope="col">{{ __('Khu vực') }}</th>
                                    <th data-property="subregion" scope="col">{{ __('Tiểu vùng') }}</th>
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