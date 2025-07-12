@extends('backoffice.layouts.master')

@php
    $title = 'Tạo Banner';
    $breadcrumbs = [
        ['label' => 'Giao diện'],
        ['label' => 'Tạo Banner'],
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
                        <h3 class="k-portlet__head-title">Thông tin Banner</h3>
                    </div>
                </div>

                <form class="k-form k-form--label-right" method="post" action="{{ route('bo.web.banners.store') }}" enctype="multipart/form-data">
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
                                    <label class="form-label">Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nhãn</label>
                                    <input type="text" class="form-control" name="label" placeholder="Nhập nhãn" value="{{ old('label') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Loại hiển thị <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control selectpicker" data-style="btn-light" required>
                                        <option value="" disabled selected>Chọn loại hiển thị</option>
                                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Banner trang chủ</option>
                                        <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Trong ứng dụng 100%</option>
                                        <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Trong ứng dụng 50%</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nhãn CTA</label>
                                    <input type="text" class="form-control" name="cta_label" placeholder="Nhập nhãn CTA" value="{{ old('cta_label') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">URL chuyển hướng</label>
                                    <input type="url" class="form-control" name="redirect_url" placeholder="Nhập URL chuyển hướng" value="{{ old('redirect_url') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Thứ tự</label>
                                    <input type="number" min="0" class="form-control" name="order" placeholder="Nhập thứ tự ưu tiên" value="{{ old('order') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Màu sắc</label>
                                    <input type="color" class="form-control" name="color" value="{{ old('color', '#000000') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Mô tả</label>
                                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày kết thúc</label>
                                            <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="k-switch">
                                        <label>
                                            <input type="checkbox" value="1" name="status" {{ old('status', 1) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="mb-4">Tải lên hình ảnh</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Hình ảnh Desktop <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control image_desktop_image_url" name="desktop_image[path]" placeholder="Tải lên hoặc nhập URL hình ảnh" value="{{ old('desktop_image.path') }}">
                                                <div class="input-group-append">
                                                    <label class="btn btn-outline-primary m-0" for="image_desktop_image">
                                                        <i class="flaticon2-image-file mr-2"></i>Tải lên
                                                        <input type="file" id="image_desktop_image" name="desktop_image[file]" class="d-none image_desktop_image_file" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <!-- Preview ảnh Desktop -->
                                                <img data-image-ref-review-img="desktop" class="img-fluid desktop-preview" style="max-width: 150px; display: none;" src="" alt="Xem trước Desktop">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Hình ảnh Mobile</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control image_mobile_image_url" name="mobile_image[path]" placeholder="Tải lên hoặc nhập URL hình ảnh" value="{{ old('mobile_image.path') }}">
                                                <div class="input-group-append">
                                                    <label class="btn btn-outline-primary m-0" for="image_mobile_image">
                                                        <i class="flaticon2-image-file mr-2"></i>Tải lên
                                                        <input type="file" id="image_mobile_image" name="mobile_image[file]" class="d-none image_mobile_image_file" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <!-- Preview ảnh Mobile -->
                                                <img data-image-ref-review-img="mobile" class="img-fluid mobile-preview" style="max-width: 150px; display: none;" src="" alt="Xem trước Mobile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                            <a href="{{ route('bo.web.banners.index') }}" class="btn btn-outline-secondary">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('backoffice.pages.banners.pagejs.banner') 
@endsection