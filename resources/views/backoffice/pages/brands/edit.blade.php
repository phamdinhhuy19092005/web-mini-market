@extends('backoffice.layouts.master')

@php
$title = __('Chỉnh sửa thương hiệu');

$breadcrumbs = [
    ['label' => __('Kho sản phẩm')],
    ['label' => __('Thương hiệu')],
    ['label' => __('Chỉnh sửa thương hiệu')],
];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title,'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md">
            <div class="k-portlet">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Chỉnh sửa thương hiệu</h3>
                    </div>
                </div>

                <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.brands.update', $brand->id) }}" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Tên thương hiệu -->
                                <div class="form-group">
                                    <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên') }}" autocomplete="off" value="{{ old('name', $brand->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Thứ tự -->
                                <div class="form-group">
                                    <label class="form-label">Thứ tự</label>
                                    <input type="number" min="0" class="form-control" name="order" placeholder="Nhập thứ tự ưu tiên" value="{{ old('order', $brand->order) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Ảnh hiển thị -->
                                <div class="form-group">
                                    <label class="form-label">{{ __('Ảnh hiển thị') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control image-url" name="image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('image.path', $brand->image) }}">
                                        <div class="input-group-append">
                                            <label class="btn btn-outline-primary m-0" for="image-file">
                                                <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                <input type="file" id="image-file" name="image[file]" class="d-none image-file" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        @if ($brand->image)
                                            <img class="img-fluid image-preview" style="max-width: 150px;" src="{{ $brand->image }}" alt="Ảnh hiện tại">
                                        @else
                                            <img class="img-fluid image-preview" style="max-width: 150px; display: none;" src="" alt="Xem trước">
                                        @endif
                                    </div>
                                    @error('image.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Trạng thái -->
                                <div class="form-group">
                                    <label class="form-label">{{ __('Hoạt động') }}</label>
                                    <div class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1" {{ old('status', $brand->status) ? 'checked' : '' }}>
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
