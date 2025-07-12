@extends('backoffice.layouts.master')

@php
    $title = __('Create Page');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Create Page'),
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
                            <h3 class="k-portlet__head-title">Create Post</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.pages.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nhập tên" autocomplete="off" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Hiển thị tại') }} *</label>
                                <select data-actions-box="true" name="display_in[]" title="-- {{ __('Chọn trang để hiển thị') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" multiple data-selected-text-format="count > 5" required>
                                    @foreach($pageDisplayInEnumLabels as $key => $label)
                                    <option
                                        {{ in_array($key, old("display_in", [])) ? 'selected' : '' }}
                                        data-tokens="{{ $key }} | {{ $label }}"
                                        data-subtext="{{ $key }}"
                                        data-name="{{ $label }}"
                                        value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slug">Đường dẫn</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn" autocomplete="off" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Tiêu đề *</label>
                                <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự hiển thị</label>
                                <input type="number" min="1" name="order" id="order" class="form-control" value="{{ old('order') }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="seo_title">[SEO] Tiêu đề</label>
                                <input type="text" name="meta_title" id="seo_title" class="form-control"
                                    placeholder="Nhập [SEO] Tiêu đề" autocomplete="off" value="{{ old('seo_title') }}">
                            </div>

                            <div class="form-group">
                                <label for="seo_description">[SEO] Mô tả</label>
                                <input type="text" name="meta_description" id="seo_description" class="form-control"
                                    placeholder="Nhập [SEO] Mô tả" autocomplete="off" value="{{ old('seo_description') }}">
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>FE</label>
                                <span class="k-switch d-flex" style="margin-left: 70px;">
                                    <label>
                                        <input type="checkbox" name="display_on_frontend" value="1" checked>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
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