@extends('backoffice.layouts.master')

@php
$title = __('Chỉnh sửa Banner');

$breadcrumbs = [
    ['label' => __('Giao diện')],
    ['label' => __('Banners')],
    ['label' => __('Chỉnh sửa Banner')],
];
@endphp

<!-- Content Head -->
@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <!-- Portlet -->
                <div class="k-portlet k-portlet--tabs">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Thông tin banner') }}</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#mainTab">
                                        {{ __('Thông tin chung') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form -->
                     <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.banners.update', $banner->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="mainTab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="{{ __('Nhập tên') }}" value="{{ old('name', $banner->name) }}" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Nhãn') }}</label>
                                            <input type="text" class="form-control" name="label" placeholder="{{ __('Nhập nhãn') }}" value="{{ old('label', $banner->label) }}">
                                            @error('label')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Loại hiển thị') }} <span class="text-danger">*</span></label>
                                            <select name="type" class="form-control selectpicker" data-style="btn-light" required>
                                                <option value="" disabled {{ old('type', $banner->type) ? '' : 'selected' }}>{{ __('Chọn loại hiển thị') }}</option>
                                                <option value="1" {{ old('type', $banner->type) == 1 ? 'selected' : '' }}>{{ __('Home Banner') }}</option>
                                                <option value="2" {{ old('type', $banner->type) == 2 ? 'selected' : '' }}>{{ __('In-App 100%') }}</option>
                                                <option value="3" {{ old('type', $banner->type) == 3 ? 'selected' : '' }}>{{ __('In-App 50%') }}</option>
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Nhãn CTA') }}</label>
                                            <input type="text" class="form-control" name="cta_label" placeholder="{{ __('Nhập nhãn CTA') }}" value="{{ old('cta_label', $banner->cta_label) }}">
                                            @error('cta_label')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Chuyển hướng URL') }}</label>
                                            <input type="url" class="form-control" name="redirect_url" placeholder="{{ __('Nhập chuyển hướng URL') }}" value="{{ old('redirect_url', $banner->redirect_url) }}">
                                            @error('redirect_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Thứ tự') }}</label>
                                            <input type="number" class="form-control" name="order" placeholder="{{ __('Nhập thứ tự ưu tiên') }}" value="{{ old('order', $banner->order) }}" min="1">
                                            @error('order')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Màu sắc') }}</label>
                                            <input type="color" class="form-control p-1" name="color" value="{{ old('color', $banner->color) }}">
                                            @error('color')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Ảnh Desktop') }} <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control desktop-image-url" name="desktop_image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('desktop_image.path', $banner->desktop_image) }}">
                                                <div class="input-group-append">
                                                    <label class="btn btn-outline-primary m-0" for="desktop-image-file">
                                                        <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                        <input type="file" id="desktop-image-file" name="desktop_image[file]" class="d-none desktop-image-file" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <img class="img-fluid desktop-image-preview" style="max-width: 150px; display: {{ $banner->desktop_image ? 'block' : 'none' }};" src="{{ $banner->desktop_image ?? '' }}" alt="Desktop Image Preview">
                                            </div>
                                            @error('desktop_image.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('Ảnh Mobile') }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mobile-image-url" name="mobile_image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('mobile_image.path', $banner->mobile_image) }}">
                                                <div class="input-group-append">
                                                    <label class="btn btn-outline-primary m-0" for="mobile-image-file">
                                                        <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                        <input type="file" id="mobile-image-file" name="mobile_image[file]" class="d-none mobile-image-file" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <img class="img-fluid mobile-image-preview" style="max-width: 150px; display: {{ $banner->mobile_image ? 'block' : 'none' }};" src="{{ $banner->mobile_image ?? '' }}" alt="Mobile Image Preview">
                                            </div>
                                            @error('mobile_image.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Mô tả') }}</label>
                                    <textarea name="description" rows="4" class="form-control">{{ old('description', $banner->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Ngày bắt đầu') }} <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at', \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i')) }}" required>
                                            @error('start_at')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Ngày kết thúc') }}</label>
                                            <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at', $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i') : '') }}">
                                            @error('end_at')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label class="form-label">{{ __('Hoạt động') }}</label>
                                    <div class="k-switch ml-3">
                                        <label>
                                            <input type="checkbox" name="status" value="1" {{ old('status', $banner->status) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('Lưu') }}</button>
                                <a href="{{ route('bo.web.banners.index') }}" class="btn btn-outline-secondary">{{ __('Huỷ') }}</a>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
                <!-- End Portlet -->
            </div>
        </div>
    </div>
@include('backoffice.pages.banners.pagejs.banner') 
@endsection

