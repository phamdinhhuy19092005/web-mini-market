@extends('backoffice.layouts.master')

@php
    $title = __('Edit Page');

    $breadcrumbs = [
        [
            'label' => __('Tiện tích'),
        ],
        [
            'label' => __('Danh sách trang'),
        ],
        [
            'label' => __('Chỉnh sửa danh sách trang'),
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
                            <h3 class="k-portlet__head-title">Chỉnh sủa trang</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
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
                                    value="{{ old('name',$page->name) }}">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Hiển thị tại') }} *</label>
                                <select data-actions-box="true" name="display_in[]" title="-- {{ __('Chọn trang để hiển thị') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" multiple data-selected-text-format="count > 5" required>
                                    @foreach($pageDisplayInEnumLabels as $key => $label)
                                    <option
                                        {{ in_array($key, old('display_in', is_string($page->display_in) ? json_decode($page->display_in, true) : ($page->display_in ?? []))) ? 'selected' : '' }}
                                        data-tokens="{{ $key }} | {{ $label }}"
                                        data-subtext="{{ $key }}"
                                        data-name="{{ $label }}"
                                        value="{{ $key }}">{{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('display_in')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="slug">Đường dẫn</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn" autocomplete="off"
                                    value="{{ old('slug',$page->slug) }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Tiêu đề *</label>
                                <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề" value="{{ old('title',$page->title) }}" required>
                            </div>


                            <div class="form-group">
                                <label for="order">Thứ tự hiển thị</label>
                                <input type="number" name="order" id="order" class="form-control" min="1" placeholder="Nhập thứ tự"
                                    value="{{ old('order',$page->order) }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <x-backoffice.content-editor
                                    id="product_description"
                                    name="content"
                                    :value="old('content', $page->content)"
                                    :cols="30"
                                    :rows="10"
                                    placeholder="Nhập nội dung..."
                                    disk="public"
                                    class=""
                                    :config="[]"
                                />
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="seo_title">[SEO] Tiêu đề</label>
                                <input type="text" name="meta_title" id="seo_title" class="form-control" placeholder="Nhập [SEO] Tiêu đề" autocomplete="off"
                                    value="{{ old('meta_title',$page->meta_title) }}">
                            </div>

                            <div class="form-group">
                                <label for="seo_description">[SEO] Mô tả</label>
                                <input type="text" name="meta_description" id="seo_description" class="form-control" placeholder="Nhập [SEO] Mô tả" autocomplete="off"
                                    value="{{ old('meta_description',$page->meta_description) }}">
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>FE</label>
                                <span class="k-switch d-flex" style="margin-left: 70px;">
                                    <label>
                                        <input type="checkbox" name="display_on_frontend" value="1"
                                            {{ old('display_on_frontend',$page->display_on_frontend) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                            {{ old('status',$page->status) ? 'checked' : '' }}>
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

@endsection


@push('scripts')
    <script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush