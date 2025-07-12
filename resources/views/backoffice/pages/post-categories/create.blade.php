@extends('backoffice.layouts.master')

@php
    $title = __('Tạo danh mục bài viết');
    $breadcrumbs = [
        ['label' => __('Tiện ích')],
        ['label' => __('Bài viết')],
        ['label' => __('Tạo danh mục bài viết')],
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
                        <h3 class="k-portlet__head-title">{{ __('Tạo danh mục bài viết') }}</h3>
                    </div>
                </div>

                <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.post-categories.store') }}" enctype="multipart/form-data">
                    @csrf

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
                                <div class="form-group">
                                    <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên danh mục') }}" autocomplete="off" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Đường dẫn') }}</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="{{ __('Nhập đường dẫn') }}" autocomplete="off" value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Thứ tự') }}</label>
                                    <input type="number" name="order" id="order" class="form-control" placeholder="{{ __('Nhập thứ tự ưu tiên') }}" min="1" autocomplete="off" value="{{ old('order') }}">
                                    @error('order')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Mô tả') }}</label>
                                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Ảnh hiển thị') }} <span class="text-danger">*</span></label>
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
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-image mt-2" style="display: none;">{{ __('Xóa ảnh') }}</button>
                                    </div>
                                    @error('image.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('[SEO] Tiêu đề') }}</label>
                                    <input type="text" name="meta_title" id="seo_title" class="form-control" placeholder="{{ __('Nhập [SEO] Tiêu đề') }}" autocomplete="off" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('[SEO] Mô tả') }}</label>
                                    <input type="text" name="meta_description" id="seo_description" class="form-control" placeholder="{{ __('Nhập [SEO] Mô tả') }}" autocomplete="off" value="{{ old('meta_description') }}">
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label class="form-label">{{ __('Hiển thị trên giao diện người dùng') }}</label>
                                    <div class="k-switch ml-3">
                                        <label>
                                            <input type="checkbox" name="display_on_frontend" value="1" {{ old('display_on_frontend', 1) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </div>
                                    @error('display_on_frontend')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label class="form-label">{{ __('Hoạt động') }}</label>
                                    <div class="k-switch ml-3">
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
                            <a href="{{ route('bo.web.post-categories.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('backoffice.pages.post-categories.pagejs.post-category');
@endsection
