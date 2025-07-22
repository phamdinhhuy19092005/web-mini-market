@extends('backoffice.layouts.master')

@php
    $title = __('Edit Post');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Blogs'),
        ],
        [
            'label' => __('Edit Post'),
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
                            <h3 class="k-portlet__head-title">Edit Post</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.auto-discounts.update', $autoDiscount->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="k-portlet__body">
                            <div class="form-group">
                                <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $autoDiscount->title) }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="code">Mã <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="code" class="form-control text-uppercase" value="{{ old('code', $autoDiscount->code) }}" required>
                                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="discount_type">Loại giảm giá <span class="text-danger">*</span></label>
                                    <select name="discount_type" id="discount_type" class="form-control k_selectpicker" required>
                                        <option value="">Chọn loại</option>
                                        @foreach($DiscountTypeEnumLabes as $item)
                                            <option value="{{ $item['value'] }}" {{ old('discount_type', $autoDiscount->discount_type) == $item['value'] ? 'selected' : '' }}>
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
                                            <option value="{{ $item['value'] }}" {{ old('condition_type', $autoDiscount->condition_type) == $item['value'] ? 'selected' : '' }}>
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
                                    <input type="number" name="discount_value" id="discount_value" class="form-control" step="0.01" min="0" value="{{ old('discount_value', $autoDiscount->discount_value) }}" required>
                                    @error('discount_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="condition_value">Giá trị điều kiện <span class="text-danger">*</span></label>
                                    <input type="text" name="condition_value" id="condition_value" class="form-control"
                                        value="{{ old('condition_value', $autoDiscount->condition_value) }}" required>
                                    @error('condition_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="usage_limit">Giới hạn sử dụng</label>
                                    <input type="number" name="usage_limit" id="usage_limit" class="form-control" min="0" value="{{ old('usage_limit', $autoDiscount->usage_limit) }}">
                                    @error('usage_limit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="start_date">Ngày bắt đầu</label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $autoDiscount->start_date) }}">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="end_date">Ngày kết thúc</label>
                                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $autoDiscount->end_date) }}">
                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả">{{ old('description', $autoDiscount->description) }}</textarea>
                                @error('description') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label class="mr-3">Kích hoạt</label>
                                <span class="k-switch">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status',$autoDiscount->status) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Include CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <style>
        /* Make CKEditor content area resizable */
        .ck-editor__editable_inline {
            resize: vertical !important;
            min-height: 200px !important;
            max-height: 800px !important;
            overflow: auto !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize CKEditor 5 on the content textarea
            ClassicEditor
                .create(document.querySelector('#content'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                    ]
                })
                .then(editor => {
                    // Ensure the editor is resizable
                    editor.ui.view.editable.element.style.resize = 'vertical';
                    editor.ui.view.editable.element.style.minHeight = '200px';
                    editor.ui.view.editable.element.style.maxHeight = '800px';
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });

            // Existing code for generating random code
            document.querySelectorAll('[data-generate]').forEach(function (button) {
                button.addEventListener('click', function () {
                    const length = parseInt(button.getAttribute('data-generate-length')) || 5;
                    const ref = button.getAttribute('data-generate-ref');
                    const isUppercase = button.getAttribute('data-generate-uppercase') === 'true';

                    const targetInput = document.querySelector(ref);
                    if (!targetInput) return;

                    const characters = isUppercase
                        ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
                        : 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

                    let result = '';
                    for (let i = 0; i < length; i++) {
                        const randomIndex = Math.floor(Math.random() * characters.length);
                        result += characters[randomIndex];
                    }

                    targetInput.value = result;
                });
            });
        });
    </script>
@endsection
