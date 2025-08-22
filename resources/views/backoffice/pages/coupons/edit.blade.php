@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa mã giảm giá');

    $breadcrumbs = [
        [
            'label' => __('Mã giảm giá'),
        ],
        [
            'label' => __('Mã giảm giá '),
        ],
        [
            'label' => __('Chỉnh sửa mã giảm giá'),
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
                            <h3 class="k-portlet__head-title">Chỉnh sửa mã giảm giá</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.coupons.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="k-portlet__body">
                            <div class="form-group">
                                <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Nhập tiêu đề" name="title" id="title" class="form-control" autocomplete="off" value="{{ old('title', $coupon->title) }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="code">Mã <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="code" class="form-control text-uppercase" autocomplete="off" value="{{ old('code', $coupon->code) }}" required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="discount_type">Loại <span class="text-danger">*</span></label>
                                    <select name="discount_type" id="discount_type" class="form-control k_selectpicker" required>
                                        <option value="">Chọn loại</option>
                                        @foreach($DiscountTypeEnumLabes as $item)
                                            <option value="{{ $item['value'] }}" {{ old('discount_type', $coupon->discount_type) == $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('discount_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="discount_value">Giá trị giảm giá <span class="text-danger">*</span></label>
                                    <input type="number" name="discount_value" id="discount_value" class="form-control"
                                           placeholder="Nhập giá trị giảm giá" step="0.01" min="0" value="{{ old('discount_value', $coupon->discount_value) }}" required>
                                    @error('discount_value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="usage_limit">Giới hạn sử dụng</label>
                                    <input type="number" name="usage_limit" id="usage_limit" class="form-control"
                                           placeholder="Nhập số lần sử dụng tối đa (tùy chọn)" min="0" value="{{ old('usage_limit', $coupon->usage_limit) }}">
                                    @error('usage_limit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="start_date">Ngày bắt đầu <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $coupon->start_date) }}" >
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="end_date">Ngày kết thúc <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $coupon->end_date) }}" >
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="content">Nội dung</label>
                                    <x-backoffice.content-editor
                                        id="terms"
                                        name="terms"
                                        :value="old('terms', $coupon->terms)"
                                        :cols="30"
                                        :rows="10"
                                        placeholder="Nhập điều khoản mã..."
                                        disk="public"
                                        class=""
                                        :config="[]"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">Kích hoạt</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1" {{ old('status', $coupon->status) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </span>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
