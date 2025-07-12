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
                    <form action="{{ route('bo.web.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên" autocomplete="off"
                                    value="{{ old('name', $post->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Đường dẫn</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn" autocomplete="off"
                                    value="{{ old('slug', $post->slug) }}">
                            </div>

                            <div class="form-group">
                                <label for="author">Người viết</label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tên"
                                    value="{{ old('author', $post->author) }}">
                            </div>

                            <div class="form-group">
                                <label for="code">Code *</label>
                                <div class="input-group">
                                    <input id="code" type="text" name="code" value="{{ old('code', $post->code) }}" class="form-control" placeholder="Nhập Code" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" data-generate="" data-generate-length="5" data-generate-ref="#code" data-generate-uppercase="true" type="button">Generate Code</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự hiển thị</label>
                                <input type="number" name="order" id="order" class="form-control" min="1" placeholder="Nhập thứ tự"
                                    value="{{ old('order', $post->order) }}">
                            </div>

                            <div class="form-group" style="width: 100%">
                                <label for="post_category_id" class="form-label fw-bold d-block mb-2">
                                    Danh mục <span class="text-danger">*</span>
                                </label>
                                <select name="post_category_id" id="post_category_id" class="form-select selectpicker" data-live-search="true" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($postCategories as $postCategory)
                                        <option value="{{ $postCategory->id }}"
                                            {{ old('post_category_id', $post->post_category_id) == $postCategory->id ? 'selected' : '' }}>
                                            {{ $postCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $post->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="post_at">Được viết lúc</label>
                                <input type="datetime-local" class="form-control" id="post_at" name="post_at"
                                    value="{{ old('post_at', \Carbon\Carbon::parse($post->post_at)->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="form-group">
                                <label for="seo_title">[SEO] Tiêu đề</label>
                                <input type="text" name="meta_title" id="seo_title" class="form-control" placeholder="Nhập [SEO] Tiêu đề" autocomplete="off"
                                    value="{{ old('meta_title', $post->meta_title) }}">
                            </div>

                            <div class="form-group">
                                <label for="seo_description">[SEO] Mô tả</label>
                                <input type="text" name="meta_description" id="seo_description" class="form-control" placeholder="Nhập [SEO] Mô tả" autocomplete="off"
                                    value="{{ old('meta_description', $post->meta_description) }}">
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>FE</label>
                                <span class="k-switch d-flex" style="margin-left: 70px;">
                                    <label>
                                        <input type="checkbox" name="display_on_frontend" value="1"
                                            {{ old('display_on_frontend', $post->display_on_frontend) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                            {{ old('status', $post->status) ? 'checked' : '' }}>
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