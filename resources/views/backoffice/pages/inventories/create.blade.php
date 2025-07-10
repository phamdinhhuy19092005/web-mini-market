@extends('backoffice.layouts.master')

@php
    $title = __('Tạo sản phẩm vào kho');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('Tạo sản phẩm vào kho')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <form id="form_inventory" method="POST" action="{{ empty($inventory->id) ? route('bo.web.inventories.store') : route('bo.web.inventories.update', $inventory->id) }}" enctype="multipart/form-data">
        @csrf

        @if (!empty($inventory->id))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="k-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand d-flex">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#Tag_General_Information">
                                {{ __('Thông tin chung') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab_Classification_Group">
                                {{ __('Nhóm phân loại') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab_SEO">
                                {{ __('Thông tin SEO') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab_Description_Information">
                                {{ __('Thông tin mô tả') }}
                            </a>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="Tag_General_Information">
                            @include('backoffice.pages.inventories.partials.tab-general-information')
                        </div>

                        <div class="tab-pane" id="Tab_Classification_Group">
                            @include('backoffice.pages.inventories.partials.tab-classification-group')
                        </div>

                        <div class="tab-pane" id="Tab_SEO">
                            @include('backoffice.pages.inventories.partials.tab-seo')
                        </div>

                        <div class="tab-pane" id="Tab_Description_Information">
                            @include('backoffice.pages.inventories.partials.tab-description-information')
                        </div>
                    </div>


                <div class="k-portlet__foot">
                    <div class="k-form__actions d-flex justify-content-start">
                        <a href="{{ route('bo.web.inventories.index') }}" class="btn btn-secondary mr-2">Huỷ</a>
                        <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    @include('backoffice.pages.posts.pagejs.post')
@endsection