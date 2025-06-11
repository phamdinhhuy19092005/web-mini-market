@extends('backoffice.layouts.master')

@php
    $title = __('Countries');

    $breadcrumbs = [
        [
            'label' => __('Areas'),
        ],
        [
            'label' => __('Countries'),
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
                            <h3 class="k-portlet__head-title">List Country</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-2">
                        <table id="table_countries_index"
                            data-searching="true"
                            data-request-url="{{ route('bo.api.countries.index') }}"
                            class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-property="name">{{ __('Name') }}</th> 
                                    <th data-property="iso3">{{ __('ISO3') }}</th>
                                    <th data-property="numeric">{{ __('Code') }}</th>
                                    <th data-property="iso2">{{ __('ISO2') }}</th>
                                    <th data-property="status">{{ __('Status') }}</th>
                                    <th data-property="phonecode">{{ __('Phone code') }}</th>
                                    <th data-property="capital">{{ __('Capital') }}</th>
                                    <th data-property="currency">{{ __('Currency') }}</th>
                                    <th data-property="currency_name">{{ __('Currency name') }}</th>
                                    <th data-property="tld">{{ __('TLD') }}</th>
                                    <th data-property="native">{{ __('Native') }}</th>
                                    <th data-property="region">{{ __('Region') }}</th>
                                    <th data-property="subregion">{{ __('Sub Gion') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @component('backoffice.partials.datatable')
    @endcomponent
@endsection
