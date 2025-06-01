@extends('backoffice.layouts.master')

@php
    $title = __('Management Categories');

    $breadcrumbs = [
        [
            'label' => __('Products'),
        ],
        [
            'label' => __('Categories'),
        ],
        [
            'label' => __('Management Categories'),
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
                            <h3 class="k-portlet__head-title">Manage Categories</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <a href="{{ route('bo.web.category-groups.create') }}" class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i> Create Category
                            </a>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit">
                       <table id="table_categories_index" data-searching="true" data-request-url="{{ route('bo.api.categories.index') }}" class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-orderable="false" data-property="image">{{ __('Image') }}</th>
                                    <th data-orderable="false" data-property="name">{{ __('Name') }}</th>
                                    <th data-orderable="false" data-property="slug">{{ __('Slug') }}</th>
                                    <th data-orderable="false" data-property="category_group_id">{{ __('Category Groups') }}</th>
                                    <th data-orderable="false" data-property="status">{{ __('Status') }}</th>
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
