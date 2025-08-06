@extends('backoffice.layouts.master')

@php
    $title = __('Tạo Bài Viết');

    $breadcrumbs = [
        [
            'label' => __('Tiện Ích'),
        ],
        [
            'label' => __('Bài Viết'),
        ],
        [
            'label' => __('Tạo Bài Viết'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- Begin::Content Body -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <!-- Begin::Portlet -->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Tạo Bài Viết Mới</h3>
                        </div>
                    </div>

                    <!-- Begin::Form -->
                    <form action="{{ route('bo.web.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                            <!-- Begin::Form Fields -->
                            <div class="row">
                                <!-- Title Field -->
                                <div class="col-md-6 form-group">
                                    <label for="name">Tiêu đề <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Nhập tiêu đề bài viết" autocomplete="off" value="{{ old('name') }}" required>
                                </div>

                                <!-- Slug Field -->
                                <div class="col-md-6 form-group">
                                    <label for="slug">Đường dẫn URL</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                           placeholder="Nhập đường dẫn URL" autocomplete="off" value="{{ old('slug') }}">
                                </div>

                                <!-- Image Upload Field -->
                                <div class="col-md-6 form-group">
                                    <label for="image-file">Ảnh đại diện</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control image-url" name="image[path]"
                                               placeholder="Tải ảnh lên hoặc nhập URL" value="{{ old('image.path') }}">
                                        <div class="input-group-append">
                                            <label class="btn btn-outline-primary m-0" for="image-file">
                                                <i class="flaticon2-image-file mr-2"></i>Tải ảnh
                                                <input type="file" id="image-file" name="image[file]"
                                                       class="d-none image-file" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <img class="img-fluid image-preview" style="max-width: 150px; display: none;"
                                             src="" alt="Ảnh xem trước">
                                    </div>
                                    @error('image.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Author Field -->
                                <div class="col-md-6 form-group">
                                    <label for="author">Tác giả</label>
                                    <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tên tác giả" value="{{ auth('admin')->user()->name ?? 'admin' }}">
                                </div>

                                <!-- Code Field -->
                                <div class="col-md-6 form-group">
                                    <label for="code">Mã bài viết <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="code" type="text" name="code" class="form-control"
                                               placeholder="Nhập mã bài viết" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" data-generate data-generate-length="5"
                                                    data-generate-ref="#code" data-generate-uppercase="true" type="button">
                                                Tạo mã
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Field -->
                                <div class="col-md-6 form-group">
                                    <label for="order">Thứ tự hiển thị</label>
                                    <input type="number" min="1" name="order" id="order" class="form-control"
                                           value="{{ old('order') }}">
                                </div>

                                <!-- Category Field -->
                                <div class="col-md-6 form-group">
                                    <label for="post_category_id">Danh mục <span class="text-danger">*</span></label>
                                    <select name="post_category_id" id="post_category_id"
                                            class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}"
                                                    {{ old('post_category_id') == $postCategory->id ? 'selected' : '' }}>
                                                {{ $postCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Post Date Field -->
                                <div class="col-md-6 form-group">
                                    <label for="post_at">Ngày đăng</label>
                                    <input type="datetime-local" class="form-control" id="post_at" name="post_at"
                                           value="{{ old('post_at') }}">
                                </div>

                                <!-- Content Field -->
                                <div class="col-md-12 form-group">
                                    <label for="content">Nội dung</label>
                                    <x-backoffice.content-editor
                                        id="post_content"
                                        name="content"
                                        :value="old('content')"
                                        :cols="30"
                                        :rows="10"
                                        placeholder="Nhập câu trả lời..."
                                        disk="public"
                                        class=""
                                        :config="[]"
                                    />
                                </div>

                                <!-- Description Field -->
                                <div class="col-md-12 form-group">
                                    <label for="description">Mô tả ngắn</label>
                                    <textarea name="description" id="description" class="form-control"
                                              rows="4">{{ old('description') }}</textarea>
                                </div>


                            </div>

                                <!-- SEO Title Field -->
                                <div class="col-md-6 form-group">
                                    <label for="seo_title">Tiêu đề SEO</label>
                                    <input type="text" name="meta_title" id="seo_title" class="form-control"
                                           placeholder="Nhập tiêu đề SEO" autocomplete="off" value="{{ old('meta_title') }}">
                                </div>

                                <!-- SEO Description Field -->
                                <div class="col-md-6 form-group">
                                    <label for="seo_description">Mô tả SEO</label>
                                    <input type="text" name="meta_description" id="seo_description" class="form-control"
                                           placeholder="Nhập mô tả SEO" autocomplete="off" value="{{ old('meta_description') }}">
                                </div>

                                <!-- Display on Frontend -->
                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">Hiển thị trên trang chính</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="checkbox" name="display_on_frontend" value="1" checked>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">Kích hoạt</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1" checked>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- End::Form Fields -->
                        </div>

                        <!-- Form Actions -->
                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </div>
                    </form>
                    <!-- End::Form -->
                </div>
                <!-- End::Portlet -->
            </div>
        </div>
    </div>
    <!-- End::Content Body -->
@endsection

@push('scripts')
<script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush
