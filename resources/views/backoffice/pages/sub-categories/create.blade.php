@extends('backoffice.layouts.master')

@php
    $title = __('Tạo danh mục con');
    $breadcrumbs = [
        ['label' => __('Products')],
        ['label' => __('Danh mục')],
        ['label' => __('Tạo danh mục con')],
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
                        <h3 class="k-portlet__head-title">{{ __('Tạo danh mục con') }}</h3>
                    </div>
                </div>

                <form method="POST" action="{{ route('bo.web.sub-categories.store') }}" class="k-form k-form--label-right" enctype="multipart/form-data">
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
                            {{-- Left Column --}}
                            <div class="col-lg-6">
                                {{-- Name --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên') }}" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('Đường dẫn') }}</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="{{ __('Nhập đường dẫn') }}" value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('Danh mục') }} <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control selectpicker" data-style="btn-light" required>
                                        <option value="" disabled selected>{{ __('-- Chọn danh mục --') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('Mô tả') }}</label>
                                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Right Column --}}
                            <div class="col-lg-6">
                                {{-- SEO Title --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('[SEO] Tiêu đề') }}</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="{{ __('Nhập [SEO] Tiêu đề') }}" value="{{ old('seo_title') }}">
                                    @error('seo_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- SEO Description --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('[SEO] Mô tả') }}</label>
                                    <input type="text" name="seo_description" id="seo_description" class="form-control" placeholder="{{ __('Nhập [SEO] Mô tả') }}" value="{{ old('seo_description') }}">
                                    @error('seo_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label class="form-label">{{ __('Hoạt động') }}</label>
                                    <div class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Lưu') }}</button>
                            <a href="{{ route('bo.web.sub-categories.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('backoffice.pages.categories.pagejs.category')
@endsection
