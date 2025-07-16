@extends('backoffice.layouts.master')

@php
    $title = __('Thông tin khách hàng');
    $breadcrumbs = [
        ['label' => __('Khách hàng')],
        ['label' => __('Thông tin khách hàng')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- Left column -->
                    <div class="col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab_general_information">
                                @include('backoffice.pages.users.partials.info')
                            </div>
                            <div class="tab-pane" id="tab_cart">
                                @include('backoffice.pages.users.partials.cart')
                            </div>
                            <div class="tab-pane" id="tab_order">
                                @include('backoffice.pages.users.partials.order')
                            </div>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div class="col-lg-4 col-sm-4">
                        <div class="k-portlet sticky-top" id="sticky-portlet" style="top: 100px; z-index: 1">
                            <div class="k-portlet__body">
                                <div class="k-section" id="tabItemSection">
                                    <div class="k-section__content">
                                        <ul class="nav nav-tabs k-nav k-nav--v2 k-nav--lg-space k-nav--bold k-nav--lg-font">
                                            <li class="k-nav__item k-nav__item--active">
                                                <a href="#tab_general_information" class="k-nav__link" data-toggle="tab">
                                                    <span class="k-nav__link-text">{{ __('Thông tin chung') }}</span>
                                                </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#tab_cart" class="k-nav__link" data-toggle="tab" data-tab="cart">
                                                    <span class="k-nav__link-text">{{ __('Giỏ hàng') }}</span>
                                                </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#tab_order" class="k-nav__link" data-toggle="tab" data-tab="order">
                                                    <span class="k-nav__link-text">{{ __('Đơn hàng') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="k-separator k-separator--border-dashed k-separator--height-xs"></div>
                                <div class="k-section__content action mt-4">
                                    @if($user->status == $activationStatus::ACTIVE)
                                        <button data-url="{{ route('bo.web.users.action.deactivate', $user->id) }}"
                                                data-type="DEACTIVATE"
                                                data-toggle="modal"
                                                data-target="#UserActionModal"
                                                class="btn_user_action btn btn-outline-danger btn-block btn-pill btn-label-danger">
                                            {{ __('Vô hiệu hóa') }}
                                        </button>
                                    @elseif($user->status == $activationStatus::INACTIVE)
                                        <button data-url="{{ route('bo.web.users.action.active', $user->id) }}"
                                                data-type="ACTIVE"
                                                data-toggle="modal"
                                                data-target="#UserActionModal"
                                                class="btn_user_action btn btn-outline-success btn-block btn-pill btn-label-success">
                                            {{ __('Kích hoạt') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="UserActionModal" tabindex="-1" role="dialog" aria-labelledby="UserActionModalLable" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vô hiệu hóa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <form id="form_user_action" method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Lí do') }}</label>
                            <textarea name="reason" class="form-control" rows="10"></textarea>
                            <input type="text" name="type" value="" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
                        <button type="submit" class="btn btn-primary" id="submitActionBtn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush