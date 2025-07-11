@extends('backoffice.layouts.master')

@php
$title = __('Manage Category Groups');

$breadcrumbs = [
    [
        'label' => __('Products'),
    ],
    [
        'label' => __('Danh mục'),
    ],
    [
        'label' => __('Manage Category Groups'),
    ],
];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title,'items' => $breadcrumbs])
@endcomponent



<!-- begin:: Content Body -->
@section('content_body')
    <!-- begin:: Content Body -->
    <div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">

                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Edit Category Groups</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                   <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.category-groups.update', $categoryGroup->id) }}" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Nhập tên') }}" autocomplete="off" value="{{ old('name', $categoryGroup->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('Đường dẫn') }}</label>
                                        <input type="text" name="slug" class="form-control" placeholder="{{ __('Nhập đường dẫn') }}" autocomplete="off" value="{{ old('slug', $categoryGroup->slug) }}">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('Mô tả') }}</label>
                                        <textarea name="description" class="form-control" rows="4">{{ old('description', $categoryGroup->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Ảnh hiển thị') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control image-url" name="image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('image.path', $categoryGroup->image) }}">
                                            <div class="input-group-append">
                                                <label class="btn btn-outline-primary m-0" for="image-file">
                                                    <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                    <input type="file" id="image-file" name="image[file]" class="d-none image-file" accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <img class="img-fluid image-preview" style="max-width: 150px; display: {{ $categoryGroup->image ? 'block' : 'none' }};" src="{{ $categoryGroup->image ?? '' }}" alt="Image preview">
                                        </div>
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('[SEO] Tiêu đề') }}</label>
                                        <input type="text" name="seo_title" class="form-control" placeholder="{{ __('Nhập [SEO] Tiêu đề') }}" autocomplete="off" value="{{ old('seo_title', $categoryGroup->seo_title) }}">
                                        @error('seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('[SEO] Mô tả') }}</label>
                                        <input type="text" name="seo_description" class="form-control" placeholder="{{ __('Nhập [SEO] Mô tả') }}" autocomplete="off" value="{{ old('seo_description', $categoryGroup->seo_description) }}">
                                        @error('seo_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group d-flex align-items-center">
                                        <label class="form-label">{{ __('Hoạt động') }}</label>
                                        <div class="k-switch ml-3">
                                            <label>
                                                <input type="checkbox" name="status" value="1" {{ old('status', $categoryGroup->status) ? 'checked' : '' }}>
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
                                <a href="{{ route('bo.web.category-groups.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>

        </div>
    </div>
    <!-- end:: Content Body -->
@endsection

@push('scripts')
<script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush