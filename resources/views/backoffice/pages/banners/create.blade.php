@extends('backoffice.layouts.master')

@php
    $title = __('Create Banner');

    $breadcrumbs = [
        [
            'label' => __('Interface'),
        ],
        [
            'label' => __('Create Banner'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent


<!-- begin:: Content Body -->
@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--tabs">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Thông tin Banner</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#mainTab">Thông tin chung</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="k-form" method="post" action="{{ route('bo.web.banners.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="mainTab">
                                <div class="form-group">
                                    <label>Tên *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="labelInput">Nhãn</label>
                                    <input type="text" class="form-control" id="labelInput" name="label" placeholder="Nhập nhãn" value="">
                                </div>

                                <div class="form-group">
                                    <label for="typeSelect">Loại hiển thị *</label>
                                    <select id="typeSelect" name="type" class="form-control selectpicker" data-style="btn-light" title="-- Chọn loại hiển thị --" required>
                                        <option value="" disabled selected>-- Chọn loại hiển thị --</option>
                                        <option value="1">Home Banner</option>
                                        <option value="2">In-App 100%</option>
                                        <option value="3">In-App 50%</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nhãn CTA</label>
                                    <input type="text" class="form-control" name="cta_label" placeholder="Nhập nhãn CTA" value="">
                                </div>

                                <div class="form-group">
                                    <label>Chuyển hướng URL</label>
                                    <input type="text" class="form-control" name="redirect_url" placeholder="Nhập chuyển hướng URL" value="">
                                </div>

                                <div class="form-group">
                                    <label>Thứ tự</label>
                                    <input type="number" min="0" class="form-control" name="order" placeholder="Nhập thứ tự ưu tiên" value="">
                                </div>

                                <div class="form-group">
                                    <label>Màu sắc</label>
                                    <input type="color" class="form-control p-1" name="color" placeholder="Nhập màu sắc" value="">
                                </div>

                                <div class="form-group">
                                    <label>Ảnh Desktop *</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="upload_image_custom position-relative">
                                                <input type="text" data-image-ref-path="desktop" data-image-ref-index="0" class="form-control image_desktop_image_url" name="desktop_image[path]" value="" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
                                                <div data-image-ref-wrapper="desktop" data-image-ref-index="0" class="d-none w-100 position-absolute" style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                    <div class="d-flex align-items-center h-100">
                                                        <img data-image-ref-img="desktop" data-image-ref-index="0" src="" alt="Image preview" class="mr-2" style="height: 100%; width: 100px;">
                                                        <span data-image-ref-delete="desktop" data-image-ref-index="0" style="font-size: 16px; cursor: pointer;">×</span>
                                                    </div>
                                                </div>
                                                <label for="image_desktop_image" class="btn position-absolute btn-secondary upload_image_custom_append_icon btn-sm d-flex" style="right: 5px; top: 4px; color:#4346CD; border: 1px solid #4346CD;">


                                                    <input type="file" id="image_desktop_image" data-image-ref-path="file" data-image-ref-index="0" name="desktop_image[file]" class="d-none image_desktop_image_file" accept="image/*">


                                                    <i class="flaticon2-image-file"></i>
                                                    <span>Tải lên</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="image_desktop_image_review">
                                                <div data-image-ref-review-wrapper="desktop" data-image-ref-index="0" class="d-none" style="width: 100px; height: 100px; border: 1px solid #ccc;">
                                                    <img data-image-ref-review-img="desktop" data-image-ref-index="0" style="width: 100%; height: 100%;" src="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Ảnh Mobile</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="upload_image_custom position-relative">
                                                <input type="text" data-image-ref-path="mobile" data-image-ref-index="0" class="form-control image_mobile_image_url" name="mobile_image[path]" value="" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
                                                <div data-image-ref-wrapper="mobile" data-image-ref-index="0" class="d-none w-100 position-absolute" style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                    <div class="d-flex align-items-center h-100">
                                                        <img data-image-ref-img="mobile" data-image-ref-index="0" src="" alt="Image preview" class="mr-2" style="height: 100%; width: 100px;">
                                                        <span data-image-ref-delete="mobile" data-image-ref-index="0" style="font-size: 16px; cursor: pointer;">×</span>
                                                    </div>
                                                </div>
                                                <label for="image_mobile_image" class="btn position-absolute btn-secondary upload_image_custom_append_icon btn-sm d-flex" style="right: 5px; top: 4px; color:#4346CD; border: 1px solid #4346CD;">


                                                    <input type="file" id="image_mobile_image" data-image-ref-path="file" data-image-ref-index="0" name="mobile_image[file]" class="d-none image_mobile_image_file" accept="image/*">


                                                    <i class="flaticon2-image-file"></i>
                                                    <span>Tải lên</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="image_mobile_image_review">
                                                <div data-image-ref-review-wrapper="mobile" data-image-ref-index="0" class="d-none" style="width: 100px; height: 100px; border: 1px solid #ccc;">
                                                    <img data-image-ref-review-img="mobile" data-image-ref-index="0" style="width: 100%; height: 100%;" src="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày bắt đầu *</label>
                                            <input type="datetime-local" class="form-control" name="start_at" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày kết thúc</label>
                                            <input type="datetime-local" class="form-control" name="end_at" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Hoạt động</label>
                                    <div class="col-3">
                                        <span class="k-switch">
                                            <label>
                                                <input type="checkbox" checked value="1" name="status">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('bo.web.banners.index') }}'">Huỷ</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
    <!-- end:: Content Body -->

    <script>
        document.querySelectorAll('.image_desktop_image_file, .image_mobile_image_file').forEach(input => {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    // Cập nhật input text với tên file
                    const inputText = document.querySelector(`input[data-image-ref-path="${input.dataset.imageRefPath === 'file' ? (input.id.includes('desktop') ? 'desktop' : 'mobile') : input.dataset.imageRefPath}"][data-image-ref-index="${input.dataset.imageRefIndex}"]`);
                    inputText.value = file.name;

                    // Hiển thị preview ảnh
                    const previewWrapper = document.querySelector(`[data-image-ref-wrapper="${input.id.includes('desktop') ? 'desktop' : 'mobile'}"][data-image-ref-index="${input.dataset.imageRefIndex}"]`);
                    const previewImg = previewWrapper.querySelector('img');
                    const reviewWrapper = document.querySelector(`[data-image-ref-review-wrapper="${input.id.includes('desktop') ? 'desktop' : 'mobile'}"][data-image-ref-index="${input.dataset.imageRefIndex}"]`);
                    const reviewImg = reviewWrapper.querySelector('img');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        reviewImg.src = e.target.result;
                        previewWrapper.classList.remove('d-none');
                        reviewWrapper.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        document.querySelectorAll('.image_desktop_image_url, .image_mobile_image_url').forEach(input => {
            input.addEventListener('input', function() {
                const url = this.value;
                if (url) {
                    const previewWrapper = document.querySelector(`[data-image-ref-wrapper="${this.dataset.imageRefPath}"][data-image-ref-index="${this.dataset.imageRefIndex}"]`);
                    const previewImg = previewWrapper.querySelector('img');
                    const reviewWrapper = document.querySelector(`[data-image-ref-review-wrapper="${this.dataset.imageRefPath}"][data-image-ref-index="${this.dataset.imageRefIndex}"]`);
                    const reviewImg = reviewWrapper.querySelector('img');

                    previewImg.src = url;
                    reviewImg.src = url;
                    previewWrapper.classList.remove('d-none');
                    reviewWrapper.classList.remove('d-none');
                }
            });
        });

        document.querySelectorAll('[data-image-ref-delete]').forEach(button => {
            button.addEventListener('click', function() {
                const path = this.dataset.imageRefDelete;
                const index = this.dataset.imageRefIndex;
                const previewWrapper = document.querySelector(`[data-image-ref-wrapper="${path}"][data-image-ref-index="${index}"]`);
                const reviewWrapper = document.querySelector(`[data-image-ref-review-wrapper="${path}"][data-image-ref-index="${index}"]`);
                const inputText = document.querySelector(`input[data-image-ref-path="${path}"][data-image-ref-index="${index}"]`);
                const inputFile = document.querySelector(`input[type="file"][data-image-ref-index="${index}"][id*="${path}"]`);

                previewWrapper.classList.add('d-none');
                reviewWrapper.classList.add('d-none');
                inputText.value = '';
                inputFile.value = '';
            });
        });
    </script>
@endsection
