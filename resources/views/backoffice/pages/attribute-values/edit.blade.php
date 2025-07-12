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

                <form action="{{ route('bo.web.attributes.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="k-portlet__body">
                        <div class="row">
                            {{-- Tên thuộc tính --}}
                            <div class="col-md-6 form-group">
                                <label for="name">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="{{ __('Nhập tên thuộc tính') }}"
                                       value="{{ old('name', $attribute->name) }}" autocomplete="off" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Loại thuộc tính --}}
                            <div class="col-md-6 form-group">
                                <label for="attribute_type">{{ __('Loại') }} <span class="text-danger">*</span></label>
                                <select name="attribute_type" id="attribute_type" class="form-control k_selectpicker" required>
                                    <option value="">{{ __('-- Chọn loại --') }}</option>
                                    @foreach($ProductAttributeTypeEnum as $key => $label)
                                        <option value="{{ $key }}" {{ old('attribute_type', $attribute->attribute_type) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('attribute_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Thứ tự hiển thị --}}
                            <div class="col-md-6 form-group">
                                <label for="order">{{ __('Thứ tự hiển thị') }}</label>
                                <input type="number" min="1" name="order" id="order" class="form-control"
                                       value="{{ old('order', $attribute->order) }}">
                                @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Danh mục --}}
                            <div class="col-md-6 form-group">
                                <label for="category_ids">{{ __('Danh mục') }} <span class="text-danger">*</span></label>
                                <select name="category_ids[]" id="category_ids" class="form-control k_selectpicker"
                                        data-live-search="true"
                                        data-none-selected-text="{{ __('-- Chọn danh mục --') }}"
                                        data-actions-box="true"
                                        data-size="5"
                                        data-selected-text-format="count > 5"
                                        multiple required>
                                    @foreach($Categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('category_ids', $attribute->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Trạng thái --}}
                            <div class="col-md-6 form-group d-flex align-items-center">
                                <label class="mr-3">{{ __('Kích hoạt') }}</label>
                                <span class="k-switch">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status', $attribute->status) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                            <a href="{{ route('bo.web.attributes.index') }}" class="btn btn-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
