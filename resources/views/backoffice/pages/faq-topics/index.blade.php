@extends('backoffice.layouts.master')

@php
    $title = __('Faq Topics');

    $breadcrumbs = [
        [
            'label' => __('Tiện ích'),
        ],
        [
            'label' => __('Chủ đề FAQs'),
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
                            <h3 class="k-portlet__head-title">Danh sách chủ đề FAQ</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.faq-topics.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Tạo chủ đề
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_faq_topics_index"
                            data-searching="true"
                            data-request-url="{{ route('bo.api.faq-topics.index') }}"
                            class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-property="name">{{ __('Tên') }}</th>
                                    <th data-property="order">{{ __('Thứ tự hiển thị') }}</th>
                                    <th data-property="status">{{ __('Trạng thái') }}</th>
                                    <th class="datatable-action" data-property="actions">{{ __('Hành động') }}</th>
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
