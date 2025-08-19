@extends('backoffice.layouts.master')

@php
    $title = __('Tạo mã giảm giá tự động');
    $breadcrumbs = [
        ['label' => __('Mã giảm giá')],
        ['label' => __('Mã giảm giá tự động')],
        ['label' => __('Tạo mã giảm giá tự động')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Tạo mã giảm giá tự động') }}</h3>
                        </div>
                    </div>

                    <form action="{{ route('bo.web.auto-discounts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="k-portlet__body">
                            <div class="form-group">
                                <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label for="discount_type">Loại giảm giá <span class="text-danger">*</span></label>
                                    <select name="discount_type" id="discount_type" class="form-control k_selectpicker" required>
                                        <option value="">Chọn loại</option>
                                        @foreach($DiscountTypeEnumLabes as $item)
                                            <option value="{{ $item['value'] }}" {{ old('discount_type') == $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('discount_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="condition_type">Điều kiện áp dụng <span class="text-danger">*</span></label>
                                    <select name="condition_type" id="condition_type" class="form-control k_selectpicker" required>
                                        <option value="">Chọn điều kiện</option>
                                        @foreach($DiscountConditionTypeEnumLables as $item)
                                            <option value="{{ $item['value'] }}" {{ old('condition_type') == $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('condition_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="discount_value">Giá trị giảm giá <span class="text-danger">*</span></label>
                                    <input type="number" name="discount_value" id="discount_value" class="form-control" step="0.01" min="0" value="{{ old('discount_value') }}" required>
                                    @error('discount_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="condition_value">Giá trị điều kiện <span class="text-danger">*</span></label>
                                    <input type="text" name="condition_value" id="condition_value" class="form-control"
                                        value="{{ old('condition_value') }}" required>
                                    @error('condition_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="usage_limit">Giới hạn sử dụng</label>
                                    <input type="number" name="usage_limit" id="usage_limit" class="form-control" min="0" value="{{ old('usage_limit') }}">
                                    @error('usage_limit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="start_date">Ngày bắt đầu</label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="end_date">Ngày kết thúc</label>
                                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="content">Điều khoản</label>
                                    <x-backoffice.content-editor
                                        id="terms"
                                        name="terms"
                                        :value="old('terms')"
                                        :cols="30"
                                        :rows="10"
                                        placeholder="Nhập điều khoản mã..."
                                        disk="public"
                                        class=""
                                        :config="[]"
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                @error('description') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label class="mr-3">Kích hoạt</label>
                                <span class="k-switch">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">Lưu mã giảm giá</button>
                                <a href="{{ route('bo.web.auto-discounts.index') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
