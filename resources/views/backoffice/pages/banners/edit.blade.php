@extends('backoffice.layouts.master')

@php
$title = __('Edit Banner');

$breadcrumbs = [
    ['label' => __('Interface')],
    ['label' => __('Edit Banner')],
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
                  <form class="k-form" method="POST" action="{{ route('bo.web.banners.update', $banner->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                        <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="{{ old('name', $banner->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="labelInput">Nhãn</label>
                                        <input type="text" class="form-control" id="labelInput" name="label" placeholder="Nhập nhãn" value="{{ old('label', $banner->label) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Loại hiển thị <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-control k_selectpicker" required>
                                            <option value="">-- Chọn loại hiển thị --</option>
                                            <option value="1" {{ old('type', $banner->type) == 1 ? 'selected' : '' }}>Home Banner</option>
                                            <option value="2" {{ old('type', $banner->type) == 2 ? 'selected' : '' }}>In-App 100%</option>
                                            <option value="3" {{ old('type', $banner->type) == 3 ? 'selected' : '' }}>In-App 50%</option>
                                        </select>
                                        @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nhãn CTA</label>
                                        <input type="text" class="form-control" name="cta_label" placeholder="Nhập nhãn CTA" value="{{ old('cta_label', $banner->cta_label) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Chuyển hướng URL</label>
                                        <input type="url" class="form-control" name="redirect_url" placeholder="Nhập chuyển hướng URL" value="{{ old('redirect_url', $banner->redirect_url) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input type="number" class="form-control" name="order" placeholder="Nhập thứ tự ưu tiên" value="{{ old('order', $banner->order) }}" min="1">
                                    </div>

                                    <div class="form-group">
                                        <label>Màu sắc</label>
                                        <input type="color" class="form-control p-1" name="color" value="{{ old('color', $banner->color) }}">
                                    </div>

                                    {{-- Ảnh Desktop --}}
                                    <div class="form-group">
                                        <label>Ảnh Desktop *</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="upload_image_custom position-relative">
                                                    <input type="text" class="form-control" id="desktop_image_path" name="desktop_image[path]" value="{{ old('desktop_image.path', $banner->desktop_image) }}" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
                                                    <label for="desktop_image_file" class="btn position-absolute btn-secondary btn-sm d-flex" style="right: 5px; top: 4px;">
                                                        <input type="file" id="desktop_image_file" name="desktop_image[file]" class="d-none" accept="image/*">
                                                        <i class="flaticon2-image-file"></i><span>Tải lên</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="desktop_image_preview" src="{{ $banner->desktop_image }}" alt="Desktop Preview" style="width: 100px; height: 100px;" class="{{ $banner->desktop_image ? '' : 'd-none' }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Ảnh Mobile --}}
                                    <div class="form-group">
                                        <label>Ảnh Mobile</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="upload_image_custom position-relative">
                                                    <input type="text" class="form-control" id="mobile_image_path" name="mobile_image[path]" value="{{ old('mobile_image.path', $banner->mobile_image) }}" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
                                                    <label for="mobile_image_file" class="btn position-absolute btn-secondary btn-sm d-flex" style="right: 5px; top: 4px;">
                                                        <input type="file" id="mobile_image_file" name="mobile_image[file]" class="d-none" accept="image/*">
                                                        <i class="flaticon2-image-file"></i><span>Tải lên</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="mobile_image_preview" src="{{ $banner->mobile_image }}" alt="Mobile Preview" style="width: 100px; height: 100px;" class="{{ $banner->mobile_image ? '' : 'd-none' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="description" rows="3" class="form-control">{{ old('description', $banner->description) }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ngày bắt đầu *</label>
                                                <input type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at', \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i')) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ngày kết thúc</label>
                                                {{-- <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at', optional($banner->end_at)->format('Y-m-d\TH:i')) }}"> --}}
                                                <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at', \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i')) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Hoạt động</label>
                                        <div class="col-3">
                                            <span class="k-switch">
                                                <label>
                                                    <input type="checkbox" value="1" name="status" {{ old('status', $banner->status) ? 'checked' : '' }}>
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


                    <!-- End Form -->
                </div>
                <!-- End Portlet -->
            </div>
        </div>
    </div>

    <script>
        document.getElementById('desktop_image_file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('desktop_image_preview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('mobile_image_file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('mobile_image_preview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('desktop_image_path').addEventListener('input', function () {
            const url = this.value;
            const preview = document.getElementById('desktop_image_preview');
            if (url) {
                preview.src = url;
                preview.classList.remove('d-none');
            }
        });

        document.getElementById('mobile_image_path').addEventListener('input', function () {
            const url = this.value;
            const preview = document.getElementById('mobile_image_preview');
            if (url) {
                preview.src = url;
                preview.classList.remove('d-none');
            }
        });
    </script>

@endsection

