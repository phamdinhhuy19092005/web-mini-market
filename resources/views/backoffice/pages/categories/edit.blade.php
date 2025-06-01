@extends('backoffice.layouts.master')

@php
$title = __('Quản lý danh mục');

$breadcrumbs = [
    [
        'label' => __('Products'),
    ],
    [
        'label' => __('Danh mục'),
    ],
    [
        'label' => __('Quản lý danh mục'),
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
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="k-portlet__body">
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục"
                                    value="{{ old('name', $category->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="text" name="slug" class="form-control" placeholder="Nhập đường dẫn"
                                    value="{{ old('slug', $category->slug) }}">
                            </div>
                            <div class="form-group">
                                <label>Nhóm danh mục</label>
                                <select name="category_group_id" class="form-control">
                                    <option value="">Chọn nhóm danh mục</option>
                                    @foreach ($categoryGroups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ old('category_group_id', $category->category_group_id) == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ảnh hiển thị</label>

                                <div>
                                    <input type="file" name="image[file]" class="form-control" accept="image/*" value="{{ $category->image }}">
                                </div>

                                <div style="margin-top: 20px;">
                                    <input type="text" name="image[path]" class="form-control" value="{{ $category->image }}">
                                </div>

                                <div class="form-group" style="margin-top: 20px;">
                                    <img src="{{ $category->image }}" alt="" width="200">
                                </div>

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="10">{{ old('description', $category->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>[SEO] Tiêu đề</label>
                                <input type="text" name="seo_title" class="form-control" placeholder="Nhập [SEO] Tiêu đề"
                                    value="{{ old('seo_title', $category->seo_title) }}">
                            </div>
                            <div class="form-group">
                                <label>[SEO] Mô tả</label>
                                <input type="text" name="seo_description" class="form-control" placeholder="Nhập [SEO] Mô tả"
                                    value="{{ old('seo_description', $category->seo_description) }}">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label>Trạng thái</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                            {{ old('status', $category->status) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="k-portlet__foot">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="reset" class="btn btn-secondary">Hủy</button>
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
