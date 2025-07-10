@extends('backoffice.layouts.master')

@php
    $title = __('Danh Sách Câu Hỏi Thường Gặp');

    $breadcrumbs = [
        [
            'label' => __('Tiện Ích'),
        ],
        [
            'label' => __('Câu Hỏi Thường Gặp'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- Begin::Content Body -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-12">
                <!-- Begin::Portlet -->
                <div class="k-portlet k-portlet--mobile">
                    <div class="k-portlet__head k-portlet__head--lg">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Danh Sách Câu Hỏi Thường Gặp</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.faqs.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Thêm Câu Hỏi Mới
                            </a>
                        </div>
                    </div>
                    <!-- Begin::Table -->
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_faqs_index"
                               data-searching="true"
                               data-request-url="{{ route('bo.api.faqs.index') }}"
                               class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">Mã</th>
                                    <th data-property="question">Câu hỏi</th>
                                    <th data-property="answer">Câu trả lời</th>
                                    <th data-property="order">Thứ tự</th>
                                    <th data-property="faq_topic_id">Chủ đề</th>
                                    <th data-property="status">Trạng thái</th>
                                    <th class="datatable-action" data-property="actions">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- End::Table -->
                </div>
                <!-- End::Portlet -->
            </div>
        </div>
    </div>
    <!-- End::Content Body -->

    @component('backoffice.partials.datatable')
    @endcomponent
@endsection