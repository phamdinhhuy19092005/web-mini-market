@extends('backoffice.layouts.master')

@php
$title = __('Edit Post Category');

$breadcrumbs = [
    [
        'label' => __('Utilities'),
    ],
    [
        'label' => __('Blogs'),
    ],
    [
        'label' => __('Edit Post Category'),
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
                    <form action="{{ route('bo.web.post-categories.update', $postCategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="k-portlet__body">
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục"
                                    value="{{ old('name', $postCategory->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="text" name="slug" class="form-control" placeholder="Nhập đường dẫn"
                                    value="{{ old('slug', $postCategory->slug) }}">
                            </div>

                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="text" name="slug" class="form-control" placeholder="Nhập đường dẫn"
                                    value="{{ old('slug', $postCategory->slug) }}">
                            </div>

                            <div class="form-group">
                                <label>Thứ tự</label>
                                <input type="number" name="slug" class="form-control" min="1" placeholder="Nhập thứ tự"
                                    value="{{ old('slug', $postCategory->order) }}">
                            </div>

                            <div class="form-group">
                                <label>Ảnh hiển thị *</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="upload_image_custom position-relative">
                                            <!-- Ô nhập URL ảnh -->
                                            <input 
                                                type="text"
                                                id="image_desktop_url"
                                                class="form-control image_input_url"
                                                name="image[path]"
                                                placeholder="Tải ảnh lên hoặc nhập URL ảnh"
                                                autocomplete="off"
                                                style="padding-right: 104px;"
                                                data-image-ref="desktop"
                                                value="{{ $postCategory->image }}"
                                            >

                                            <!-- Xem trước ảnh khi có URL hoặc upload -->
                                            <div class="d-none w-100 position-absolute preview-wrapper" data-image-ref="desktop"
                                                style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                <div class="d-flex align-items-center h-100">
                                                    <img src="" alt="Image preview" class="mr-2 preview-img" style="height: 100%; width: 100px;">
                                                    <span class="delete-image" style="font-size: 16px; cursor: pointer;">×</span>
                                                </div>
                                            </div>

                                            <!-- Nút upload -->
                                            <label class="btn position-absolute btn-secondary btn-sm d-flex upload-btn"
                                                style="right: 5px; top: 4px; color:#4346CD; border: 1px solid #4346CD;">
                                                <input type="file"
                                                    id="image_desktop_file"
                                                    name="image[file]"
                                                    class="d-none image_input_file"
                                                    accept="image/*"
                                                    data-image-ref="desktop">
                                                <i class="flaticon2-image-file"></i>
                                                <span>Tải lên</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Hiển thị xem trước ảnh bên cạnh -->
                                    <div class="col-md-6">
                                        <div class="image-preview-box" data-image-ref="desktop"
                                            style="width: 100px; height: 100px; border: 1px solid #ccc;" class="d-none">
                                            <img src="{{ $postCategory->image }}" alt="" style="width: 100%; height: 100%;" class="review-img">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="10">{{ old('description', $postCategory->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>[SEO] Tiêu đề</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Nhập [SEO] Tiêu đề"
                                    value="{{ old('seo_title', $postCategory->meta_title) }}">
                            </div>
                            <div class="form-group">
                                <label>[SEO] Mô tả</label>
                                <input type="text" name="meta_description" class="form-control" placeholder="Nhập [SEO] Mô tả"
                                    value="{{ old('seo_description', $postCategory->meta_description) }}">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label>FE</label>
                                <span class="k-switch d-flex" style="margin-left: 70px;">
                                    <label>
                                        <input type="checkbox" name="display_on_frontend" value="1"
                                            {{ old('display_on_frontend', $postCategory->display_on_frontend) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label>Trạng thái</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                            {{ old('status', $postCategory->status) ? 'checked' : '' }}>
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

     <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.image_input_file').forEach(input => {
                input.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    const ref = e.target.dataset.imageRef;

                    if (file) {
                        const inputText = document.querySelector(`input.image_input_url[data-image-ref="${ref}"]`);
                        const previewWrapper = document.querySelector(`.preview-wrapper[data-image-ref="${ref}"]`);
                        const previewImg = previewWrapper?.querySelector('.preview-img');
                        const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                        const reviewImg = reviewBox?.querySelector('img');

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            if (previewImg) previewImg.src = e.target.result;
                            if (reviewImg) reviewImg.src = e.target.result;

                            previewWrapper?.classList.remove('d-none');
                            reviewBox?.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);

                        if (inputText) {
                            inputText.value = file.name;
                        }
                    }
                });
            });

            document.querySelectorAll('.image_input_url').forEach(input => {
                input.addEventListener('input', function () {
                    const url = input.value;
                    const ref = input.dataset.imageRef;

                    const previewWrapper = document.querySelector(`.preview-wrapper[data-image-ref="${ref}"]`);
                    const previewImg = previewWrapper?.querySelector('.preview-img');
                    const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                    const reviewImg = reviewBox?.querySelector('img');

                    if (url) {
                        if (previewImg) previewImg.src = url;
                        if (reviewImg) reviewImg.src = url;
                        previewWrapper?.classList.remove('d-none');
                        reviewBox?.classList.remove('d-none');
                    } else {
                        previewWrapper?.classList.add('d-none');
                        reviewBox?.classList.add('d-none');
                    }
                });
            });

            document.querySelectorAll('.delete-image').forEach(btn => {
                btn.addEventListener('click', function () {
                    const previewWrapper = btn.closest('.preview-wrapper');
                    const ref = previewWrapper?.dataset.imageRef;
                    const reviewBox = document.querySelector(`.image-preview-box[data-image-ref="${ref}"]`);
                    const inputText = document.querySelector(`input.image_input_url[data-image-ref="${ref}"]`);
                    const inputFile = document.querySelector(`input.image_input_file[data-image-ref="${ref}"]`);
                    const previewImg = previewWrapper?.querySelector('.preview-img');
                    const reviewImg = reviewBox?.querySelector('img');

                    // Clear data
                    if (previewImg) previewImg.src = '';
                    if (reviewImg) reviewImg.src = '';
                    if (inputText) inputText.value = '';
                    if (inputFile) inputFile.value = '';

                    previewWrapper?.classList.add('d-none');
                    reviewBox?.classList.add('d-none');
                });
            });
        });
    </script>

@endsection
