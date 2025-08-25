@extends('backoffice.layouts.master')

@php
$title = __('Chỉnh sửa danh mục con');

$breadcrumbs = [
    [
        'label' => __('Kho sản phẩm'),
    ],
    [
        'label' => __('Danh mục'),
    ],
    [
        'label' => __('Chỉnh sửa danh mục con'),
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
                            <h3 class="k-portlet__head-title">Chỉnh sửa nhóm danh mục</h3>
                        </div>
                        <div class="k-portlet__head-label">
                            {{-- @can('sub-categories.delete') --}}
                                {{-- <form id="delete-form" action="{{ route('bo.web.sub-categories.destroy', $sub_category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhóm danh mục này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button style="width: 150px" type="submit" class="btn btn-danger ml-2">{{ __('Xóa') }}</button>
                                </form> --}}
                            {{-- @endcan --}}
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.sub-categories.update', $sub_category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="k-portlet__body">
                            <div class="row">
                                {{-- Left Column --}}
                                <div class="col-lg-6">
                                    {{-- Name --}}
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên') }}" value="{{ old('name', $sub_category->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Slug --}}
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Đường dẫn') }}</label>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="{{ __('Nhập đường dẫn') }}" value="{{ old('slug', $sub_category->slug) }}">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Danh mục') }} <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control selectpicker" data-style="btn-light" required>
                                            <option value="" disabled>{{ __('-- Chọn danh mục --') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $sub_category->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Right Column --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Ảnh hiển thị') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control image-url" name="image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('image.path', $sub_category->image) }}">
                                            <div class="input-group-append">
                                                <label class="btn btn-outline-primary m-0" for="image-file">
                                                    <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                    <input type="file" id="image-file" name="image[file]" class="d-none image-file" accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <img class="img-fluid image-preview" style="max-width: 150px; display: {{ $sub_category->image ? 'block' : 'none' }};" src="{{ $sub_category->image ?? '' }}" alt="Image preview">
                                        </div>
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- SEO Title --}}
                                    <div class="form-group">
                                        <label class="form-label">{{ __('[SEO] Tiêu đề') }}</label>
                                        <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="{{ __('Nhập [SEO] Tiêu đề') }}" value="{{ old('seo_title', $sub_category->seo_title) }}">
                                        @error('seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- SEO Description --}}
                                    <div class="form-group">
                                        <label class="form-label">{{ __('[SEO] Mô tả') }}</label>
                                        <input type="text" name="seo_description" id="seo_description" class="form-control" placeholder="{{ __('Nhập [SEO] Mô tả') }}" value="{{ old('seo_description', $sub_category->seo_description) }}">
                                        @error('seo_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mr-3">Kích hoạt</label>
                                        <span class="k-switch">
                                            <label>
                                                <input type="checkbox" name="status" value="1"
                                                    {{ old('status', $sub_category->status) ? 'checked' : '' }}>
                                                <span></span>
                                            </label>
                                        </span>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Mô tả') }}</label>
                                <x-backoffice.content-editor
                                        id="product_description"
                                        name="description"
                                        :value="old('description',$sub_category->description)"
                                        :cols="30"
                                        :rows="10"
                                        placeholder="Nhập mô tả..."
                                        disk="public"
                                        class=""
                                        :config="[]"
                                    />
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('Lưu') }}</button>
                                <a href="{{ route('bo.web.sub-categories.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
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
