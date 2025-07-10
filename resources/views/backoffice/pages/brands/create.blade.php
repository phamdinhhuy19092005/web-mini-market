@extends('backoffice.layouts.master')

@php
    $title = __('Tạo Thương hiệu');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('THương hiệu')],
        ['label' => __('Tạo Thương hiệu')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Tạo Thương hiệu') }}</h3>
                    </div>
                </div>

                <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.brands.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="k-portlet__body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên') }}" autocomplete="off" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Thứ tự</label>
                                    <input type="number" min="0" class="form-control" name="order" placeholder="Nhập thứ tự ưu tiên" value="{{ old('order') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Ảnh hiển thị') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control image-url" name="image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('image.path') }}">
                                        <div class="input-group-append">
                                            <label class="btn btn-outline-primary m-0" for="image-file">
                                                <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                <input type="file" id="image-file" name="image[file]" class="d-none image-file" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <img class="img-fluid image-preview" style="max-width: 150px; display: none;" src="" alt="Image preview">
                                    </div>
                                    @error('image.path')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @error('image.file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Hoạt động') }}</label>
                                    <div class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Lưu') }}</button>
                            <a href="{{ route('bo.web.brands.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('backoffice.pages.brands.pagejs.brand');
@endsection