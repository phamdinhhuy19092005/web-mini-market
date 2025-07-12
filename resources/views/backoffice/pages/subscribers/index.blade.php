@extends('backoffice.layouts.master')

@php
    $title = __('Người đăng ký');

    $breadcrumbs = [
        [
            'label' => __('Hỗ trợ khách hàng'),
        ],
        [
            'label' => __('Người đăng ký'),
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
                            <h3 class="k-portlet__head-title">List Subcriber</h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_subscribers_index" data-searching="true" data-request-url="{{ route('bo.api.subscribers.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-orderable="false" data-property="email">{{ __('E-mail') }}</th>
                                    <th data-orderable="false" data-property="type_name">{{ __('Loại') }}</th>
                                    <th data-orderable="false" data-property="created_at">{{ __('Đã đăng ký lúc') }}</th>
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
