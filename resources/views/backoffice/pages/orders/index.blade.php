@extends('backoffice.layouts.master')

@php
    $title = __('Quản lý đơn hàng');
    $breadcrumbs = [
        ['label' => __('Quản lý mua hàng')],
        ['label' => __('Quản lý đơn hàng')],
    ];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-12">

            @include('backoffice.pages.orders.partials.statistic')

            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Danh sách đơn hàng') }}</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.orders.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo đơn hàng') }}
                        </a>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_order_index" class="table table-striped table-bordered table-hover table-checkable datatable"
                           data-request-url="{{ route('bo.api.orders.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th data-property="id">{{ __('ID') }}</th>
                                <th data-property="order_code">{{ __('Mã đơn hàng') }}</th>
                                <th data-property="fullname">{{ __('Tên KH') }}</th>
                                <th data-property="email">{{ __('Email') }}</th>
                                <th data-property="phone">{{ __('Phone') }}</th>
                                <th data-property="total_item">{{ __('Tổng sản phẩm') }}</th>
                                <th data-property="total_quantity">{{ __('Tổng số lượng') }}</th>
                                <th data-property="total_price">{{ __('Tổng') }}</th>
                                <th class="none" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                <th class="none" data-property="updated_at">{{ __('Ngày cập nhật') }}</th>
                                <th data-property="actions" class="datatable-action" data-render-callback="renderActions" aria-label="Hành động">{{ __('Hành động') }}</th>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statisticElements = document.querySelectorAll('h1[data-order-status]');

            statisticElements.forEach(function (element) {
                const apiUrl = element.getAttribute('data-api');

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        element.textContent = data.count ?? 0;
                    })
                    .catch(error => {
                        console.error('Error fetching order status count:', error);
                        element.textContent = '0';
                    });
            });
        });
    </script>
@endpush

@component('backoffice.partials.datatable')
@endcomponent
