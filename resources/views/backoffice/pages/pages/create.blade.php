@extends('backoffice.layouts.master')

@php
    $title = __('Tạo trang');
    $breadcrumbs = [
        ['label' => __('Tiện ích')],
        ['label' => __('Danh sách trang')],
        ['label' => __('Tạo trang')],
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
                        <h3 class="k-portlet__head-title">Tạo trang</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.pages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Nhập tên" autocomplete="off" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Hiển thị tại *</label>
                            <select name="display_in[]"
                                    title="-- {{ __('Chọn trang để hiển thị') }} --"
                                    class="form-control k_selectpicker"
                                    multiple
                                    data-actions-box="true"
                                    data-size="5"
                                    data-live-search="true"
                                    data-selected-text-format="count > 5"
                                    required>
                                @foreach($pageDisplayInEnumLabels as $key => $label)
                                    <option value="{{ $key }}"
                                            {{ in_array($key, old('display_in', [])) ? 'selected' : '' }}
                                            data-tokens="{{ $key }} | {{ $label }}"
                                            data-subtext="{{ $key }}"
                                            data-name="{{ $label }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="slug">Đường dẫn</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   placeholder="Nhập đường dẫn" autocomplete="off" value="{{ old('slug') }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề *</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="Nhập tiêu đề" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" min="1" name="order" id="order" class="form-control"
                                   value="{{ old('order') }}">
                        </div>

                        <div class="form-group">
                            <label for="content">Mô tả</label>
                            <x-backoffice.content-editor
                                id="content"
                                name="content"
                                :value="old('content')"
                                :cols="30"
                                :rows="10"
                                placeholder="Nhập nội dung..."
                                disk="public"
                                class=""
                                :config="[]"
                            />
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seo_title">[SEO] Tiêu đề</label>
                            <input type="text" name="meta_title" id="seo_title" class="form-control"
                                   placeholder="Nhập [SEO] Tiêu đề" autocomplete="off" value="{{ old('meta_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="seo_description">[SEO] Mô tả</label>
                            <input type="text" name="meta_description" id="seo_description" class="form-control"
                                   placeholder="Nhập [SEO] Mô tả" autocomplete="off" value="{{ old('meta_description') }}">
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label>FE</label>
                            <span class="k-switch" style="margin-left: 70px;">
                                <label>
                                    <input type="checkbox" name="display_on_frontend" value="1" checked>
                                    <span></span>
                                </label>
                            </span>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label>Hoạt động</label>
                            <span class="k-switch" style="margin-left: 20px;">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush
