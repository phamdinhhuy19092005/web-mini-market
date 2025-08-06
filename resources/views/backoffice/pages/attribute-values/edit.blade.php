@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa thuộc tính');
    $breadcrumbs = [
        ['label' => __('Thuộc tính')],
        ['label' => __('Chỉnh sửa thuộc tính')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md">
            <div class="k-portlet">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Chỉnh sửa thuộc tính') }}</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.attribute-values.update', $attribute_value->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="k-portlet__body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="attributes">{{ __('Thuộc tính') }} <span class="text-danger">*</span></label>
                                <select name="attribute_id" id="attributes" class="form-control k_selectpicker"
                                        data-live-search="true"
                                        data-none-selected-text="{{ __('-- Chọn thuộc tính --') }}"
                                        data-actions-box="true"
                                        data-size="5"
                                        data-selected-text-format="count > 5"
                                        required>
                                    <option value="">{{ __('-- Chọn thuộc tính --') }}</option>
                                    @foreach($Attributes as $attribute)
                                        <option value="{{ $attribute->id }}"
                                            {{ old('attribute_id', $attribute_value->attribute_id) == $attribute->id ? 'selected' : '' }}>
                                            {{ $attribute->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('attribute_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="name">{{ __('Giá trị') }} <span class="text-danger">*</span></label>
                                <input type="text" name="value" id="name" class="form-control"
                                       placeholder="{{ __('Nhập giá trị') }}"
                                       value="{{ old('value', $attribute_value->value) }}" autocomplete="off" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="order">{{ __('Thứ tự hiển thị') }}</label>
                                <input type="number" min="1" name="order" id="order" class="form-control"
                                       value="{{ old('order', $attribute_value->order) }}">
                                @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group d-flex align-items-center">
                                <label class="form-label">{{ __('Trạng thái') }}</label>
                                <div class="k-switch ml-3">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status', $attribute_value->status) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                            <a href="{{ route('bo.web.attribute-values.index') }}" class="btn btn-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
