@extends('backoffice.layouts.master')

@php
    $title = __('Create Menu Group');

    $breadcrumbs = [
        [
            'label' => __('Interface'),
        ],
        [
            'label' => __('Danh mục'),
        ],
        [
            'label' => __('Create menu group'),
        ],
    ];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent


<!-- begin:: Content Body -->
@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body"><div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--tabs">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Thông tin nhóm menu</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#mainTab">
                                    Thông tin chung
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#advanceTab">
                                    Nâng cao
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="k-form" name="form_menu_groups" id="form_menu_groups" method="post" action="http://127.0.0.1:8001/bo/menu-groups">
                    <input type="hidden" name="_token" value="Qi8oiXMheIMm3h1FvJ9KQ3xO33gMHUAOqO7ifuBb">
                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="mainTab">
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="redirect_url" class="form-label">Chuyển hướng URL</label>
                                    <input type="text" class="form-control" id="redirect_url" name="redirect_url" placeholder="Nhập URL chuyển hướng" value="">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="order" class="form-label">Thứ tự</label>
                                    <input type="number" class="form-control" id="order" name="order" placeholder="Nhập thứ tự ưu tiên" value="">
                                </div>

                                <div class="form-group d-flex align-items-center">
                                <label>Hiển thị FE</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            </div>
                            <div class="tab-pane" id="advanceTab">
                                <div class="form-group mb-4">
                                    <label for="json_editor_params" class="form-label">Behavior</label>
                                    <div id="json_editor_params" style="height: 200px;" class="ace_editor ace_hidpi ace-tomorrow">
                                        <textarea class="ace_text-input" wrap="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="opacity: 0; font-size: 1px; height: 1px; width: 1px; transform: translate(44px, 16px);"></textarea>
                                        <div class="ace_gutter" aria-hidden="true" style="left: 0px; width: 41px;">
                                            <div class="ace_layer ace_gutter-layer ace_folding-enabled" style="height: 1e+06px; transform: translate(0px, 0px); width: 41px;">
                                                <div class="ace_gutter-cell ace_gutter-active-line" style="height: 16px; top: 0px;">1<span style="display: none;"></span></div>
                                            </div>
                                        </div>
                                        <div class="ace_scroller" style="left: 40.2012px; right: 0px; bottom: 0px;">
                                            <div class="ace_content" style="transform: translate(0px, 0px); width: 1080px; height: 232px;">
                                                <div class="ace_layer ace_print-margin-layer">
                                                    <div class="ace_print-margin" style="left: 4px; visibility: visible;"></div>
                                                </div>
                                                <div class="ace_layer ace_marker-layer">
                                                    <div class="ace_active-line" style="height: 16px; top: 0px; left: 0px; right: 0px;"></div>
                                                </div>
                                                <div class="ace_layer ace_text-layer" style="height: 1e+06px; margin: 0px 4px; transform: translate(0px, 0px);">
                                                    <div class="ace_line" style="height: 16px; top: 0px;">
                                                        <span class="ace_paren ace_lparen">{</span><span class="ace_paren ace_rparen">}</span>
                                                    </div>
                                                </div>
                                                <div class="ace_layer ace_marker-layer"></div>
                                                <div class="ace_layer ace_cursor-layer ace_hidden-cursors">
                                                    <div class="ace_cursor" style="display: block; transform: translate(4px, 0px); width: 7px; height: 16px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ace_scrollbar ace_scrollbar-v" style="display: none; width: 20px; bottom: 0px;">
                                            <div class="ace_scrollbar-inner" style="width: 20px; height: 16px;"></div>
                                        </div>
                                        <div class="ace_scrollbar ace_scrollbar-h" style="display: none; height: 20px; left: 40.2012px; right: 0px;">
                                            <div class="ace_scrollbar-inner" style="height: 20px; width: 1080px;"></div>
                                        </div>
                                        <div style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font: inherit; overflow: hidden;">
                                            <div style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font: inherit; overflow: visible;">

                                            </div>
                                            <div style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; overflow: visible;">

                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="params" value="{}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='/bo/menu-groups'">Huỷ</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
    <!-- end:: Content Body -->
@endsection
