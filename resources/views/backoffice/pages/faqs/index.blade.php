@extends('backoffice.layouts.master')

@php
    $title = __('Faqs');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Faqs'),
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
                            <h3 class="k-portlet__head-title">List Faq</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.faqs.create') }}" class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Create Faq
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-2">
                        <table id="table_faqs_index"
                            data-searching="true"
                            data-request-url="{{ route('bo.api.faqs.index') }}"
                            class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-property="question">{{ __('Question') }}</th>
                                    <th data-property="answer">{{ __('Answer') }}</th>
                                    <th data-property="order">{{ __('Order') }}</th>
                                    <th data-property="faq_topic_id">{{ __('Topic') }}</th>
                                    <th data-property="status">{{ __('Status') }}</th>
                                    <th class="datatable-action" data-property="actions">{{ __('Action') }}</th>
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
