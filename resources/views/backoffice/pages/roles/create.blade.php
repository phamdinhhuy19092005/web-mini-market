@extends('backoffice.layouts.master')

@php
    $title = __('Create Access rights');
    $breadcrumbs = [
        ['label' => __('Administration')],
        ['label' => __('Create Access rights')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <div class="k-portlet k-portlet--tabs">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Access rights information') }}</h3>
                    </div>
                </div>

                <form class="k-form" method="POST" action="{{ route('bo.web.roles.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="mainTab">
                                <!-- Role Input -->
                                <div class="form-group">
                                    <label>{{ __('Role') }} *</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ __('Enter role') }}" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <div class="k-section">
                                        <label>{{ __('Permissions') }}</label>
                                        <ul id="m_nav" class="k-nav k-nav--active-bg">
                                            <li class="k-nav__item custom">
                                                <div class="d-flex align-items-center">
                                                    <span class="k-nav__link-bullet">
                                                        <input class="permission-checkbox" type="checkbox" id="checkable_checkall" />
                                                    </span>
                                                    <label for="checkable_checkall" class="k-nav__link permission-navlink">
                                                        <span class="k-nav__link-text">-- {{ __('Select All') }} --</span>
                                                    </label>
                                                </div>
                                            </li>

                                            @foreach($groups as $groupName => $subPermissions)
                                                @if(is_array($subPermissions) && !empty($subPermissions))
                                                    @php
                                                        $groupId = str_replace('.', '-', $groupName);
                                                    @endphp
                                                    <li class="k-nav__item custom collapser">
                                                        <div class="d-flex align-items-center">
                                                            <input class="collapser-input mr-2" type="checkbox" parent-key="all" id="{{ $groupName }}">
                                                            <a href="#co_{{ $groupId }}" class="k-nav__link permission-navlink collapsed" data-toggle="collapse">
                                                                <span class="k-nav__link-text">{{ __("backoffice::permissions.{$groupName}") }}</span>
                                                                <span class="k-nav__link-arrow"></span>
                                                            </a>
                                                        </div>
                                                        <ul class="k-nav__sub collapse mt-2 pl-4" id="co_{{ $groupId }}">
                                                            @foreach($subPermissions as $permission)
                                                                <li class="k-nav__item custom d-flex align-items-center py-1">
                                                                    <input class="permission-checkbox mr-3" parent-key="{{ $groupName }}" name="permissions[{{ $permission }}]" type="checkbox" id="{{ str_replace('.', '-', $permission) }}">
                                                                    <label class="mb-0 k-nav__link-text" for="{{ str_replace('.', '-', $permission) }}">
                                                                        {{ __("backoffice::permissions.{$permission}") }}
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('bo.web.roles.index') }}'">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Tùy chỉnh CSS để giao diện giống hình ảnh */
.k-nav__sub {
    list-style: none;
    padding-left: 30px; /* Thụt lề cho các mục con */
}

.k-nav__sub .k-nav__item {
    margin-bottom: 5px; /* Khoảng cách giữa các mục con */
}

.k-nav__link-text {
    font-size: 14px;
    line-height: 1.5;
}

.permission-checkbox,
.collapser-input {
    width: 16px;
    height: 16px;
}

.k-nav__item.custom {
    margin-bottom: 8px;
}

.k-nav__link-arrow {
    margin-left: 5px;
}

/* Đảm bảo mục con hiển thị dưới dạng block */
.k-nav__sub.collapse {
    display: none;
}

.k-nav__sub.collapse.show {
    display: block;
}
</style>

@include('backoffice.pages.roles.js.role')
@endsection