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


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent


<!-- begin:: Content Body -->
@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">

                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Tạo danh mục</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nhập tên" autocomplete="off" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Đường dẫn</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    placeholder="Nhập đường dẫn" autocomplete="off" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label for="category_group_id">Nhóm danh mục *</label>
                                <select name="category_group_id" id="category_group_id" class="form-control" required>
                                    <option value="">-- Chọn nhóm danh mục --</option>
                                    @foreach($categoryGroups as $group)
                                        <option style="padding: 10px" value="{{ $group->id }}" {{ old('category_group_id') == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Ảnh hiển thị</label>
                                <div>
                                    <input type="file" name="image[file]" class="form-control" accept="image/*">
                                </div>
                                <div>
                                    <input type="text" name="image[path]" class="form-control">
                                </div>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="seo_title">[SEO] Tiêu đề</label>
                                <input type="text" name="seo_title" id="seo_title" class="form-control"
                                    placeholder="Nhập [SEO] Tiêu đề" autocomplete="off" value="{{ old('seo_title') }}">
                            </div>

                            <div class="form-group">
                                <label for="seo_description">[SEO] Mô tả</label>
                                <input type="text" name="seo_description" id="seo_description" class="form-control"
                                    placeholder="Nhập [SEO] Mô tả" autocomplete="off" value="{{ old('seo_description') }}">
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

                        <div class="card-footer">
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
