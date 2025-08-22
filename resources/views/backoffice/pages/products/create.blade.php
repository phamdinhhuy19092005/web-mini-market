@extends('backoffice.layouts.master')

@php
    $title = __('Tạo sản phẩm');
    $breadcrumbs = [
        ['label' => __('Quản lý sản phẩm')],
        ['label' => __('Sản phẩm')],
        ['label' => __('Tạo Sản phẩm')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('bo.web.products.store')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left Column: Main Information -->
                        <div class="col-md-8">
                            <div class="k-portlet">
                                <div class="k-portlet__head">
                                    <div class="k-portlet__head-label">
                                        <h3 class="k-portlet__head-title">Thông tin chính</h3>
                                    </div>
                                </div>
                                <div class="k-portlet__body">
                                    <!-- Name Field -->
                                    <div class="form-group">
                                        <label for="name">Tên <span class="text-danger">*</span></label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control"
                                               placeholder="Nhập tên sản phẩm"
                                               autocomplete="off"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Slug Field -->
                                    <div class="form-group">
                                        <label for="slug">Đường dẫn URL</label>
                                        <input type="text"
                                               name="slug"
                                               id="slug"
                                               class="form-control"
                                               placeholder="Nhập đường dẫn URL"
                                               autocomplete="off"
                                               value="{{ old('slug') }}">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Code Field -->
                                    <div class="form-group">
                                        <label for="code">SKU sản phẩm <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="code"
                                                   type="text"
                                                   name="code"
                                                   class="form-control"
                                                   placeholder="Nhập mã sản phẩm"
                                                   required
                                                   value="{{ old('code') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"
                                                        data-generate
                                                        data-generate-length="8"
                                                        data-generate-ref="#code"
                                                        data-generate-uppercase="true"
                                                        type="button">
                                                    Tạo mã
                                                </button>
                                            </div>
                                        </div>
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                   <!-- Primary Image Upload -->
                                    <div class="form-group mb-4">
                                        <label for="primary-image-file" class="form-label">Hình ảnh chính</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control image-url"
                                                name="primary_image[path]"
                                                placeholder="Tải ảnh lên hoặc nhập URL"
                                                value="{{ old('primary_image.path') }}">
                                            <div class="input-group-append">
                                                <label class="btn btn-outline-primary m-0">
                                                    <i class="flaticon2-image-file mr-2"></i> Tải ảnh
                                                    <input type="file"
                                                        id="primary-image-file"
                                                        name="primary_image[file]"
                                                        class="d-none image-file"
                                                        accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-2 image-preview-container">
                                            <img class="img-fluid image-preview"
                                                style="max-width: 150px; display: none;"
                                                src=""
                                                alt="Ảnh xem trước">
                                        </div>
                                        @error('primary_image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Media Gallery -->
                                    <div id="media-gallery-wrapper" class="mb-4" style="width:500px;">
                                        <!-- Template ảnh bộ sưu tập -->
                                        <template id="media-image-template">
                                            <div class="media-image-item form-group">
                                                <div class="d-flex">
                                                    <div class="input-group">
                                                        <input type="text"
                                                            class="form-control image-url"
                                                            name="media[path][]"
                                                            placeholder="Tải ảnh lên hoặc nhập URL">
                                                        <div class="input-group-append">
                                                            <label class="btn btn-outline-primary m-0">
                                                                <i class="flaticon2-image-file mr-2"></i> Tải ảnh
                                                                <input type="file"
                                                                    class="d-none image-file"
                                                                    name="media[file][]"
                                                                    accept="image/*">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary remove-media-image" style="margin-left: 10px">Xóa</button>
                                                </div>
                                                <div class="mt-2 d-flex align-items-center gap-2">
                                                    <img class="img-fluid image-preview"
                                                        style="max-width: 150px; display: none;"
                                                        src=""
                                                        alt="Ảnh xem trước">
                                                </div>
                                            </div>
                                        </template>

                                        <label class="form-label">{{ __('Bộ sưu tập ảnh') }}</label>
                                        <div class="media-image-item form-group">
                                            <div class="d-flex">
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control image-url"
                                                        name="media[path][]"
                                                        placeholder="Tải ảnh lên hoặc nhập URL">
                                                    <div class="input-group-append">
                                                        <label class="btn btn-outline-primary m-0">
                                                            <i class="flaticon2-image-file mr-2"></i> Tải ảnh
                                                            <input type="file"
                                                                class="d-none image-file"
                                                                name="media[file][]"
                                                                accept="image/*">
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary remove-media-image" style="margin-left: 10px"> Xóa </button>
                                            </div>
                                            <div class="mt-2 d-flex align-items-center gap-2">
                                                <img class="img-fluid image-preview"
                                                    style="max-width: 150px; display: none;"
                                                    src=""
                                                    alt="Ảnh xem trước">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nút Thêm ảnh -->
                                    <div class="form-group">
                                        <button type="button" id="add-media-image" class="btn btn-sm btn-secondary mt-2">
                                            + Thêm ảnh
                                        </button>
                                    </div>



                                    <!-- Description Field -->
                                    <div class="form-group">
                                        <label for="content">Mô tả</label>
                                        <x-backoffice.content-editor
                                            id="product_description"
                                            name="description"
                                            :value="old('description')"
                                            :cols="30"
                                            :rows="10"
                                            placeholder="Nhập mô tả..."
                                            disk="public"
                                            class=""
                                            :config="[]"
                                        />
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Additional Information -->
                        <div class="col-md-4">
                            <div class="k-portlet">
                                <div class="k-portlet__head">
                                    <div class="k-portlet__head-label">
                                        <h3 class="k-portlet__head-title">Thông tin bổ sung</h3>
                                    </div>
                                </div>
                                <div class="k-portlet__body">
                                    <!-- Category Field -->
                                    <div class="form-group">
                                        <label>{{ __('Danh mục') }} *</label>
                                        <select name="category_ids[]" id="category_ids" class="form-control k_selectpicker" multiple data-actions-box="true" required data-live-search="true" data-none-selected-text="-- Chọn danh mục --">
                                            @foreach($categoryGroups as $categoryGroup)
                                                <optgroup label="{{ $categoryGroup->name }}">
                                                    @foreach($categoryGroup->categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Subcategory Field -->
                                    <div class="form-group">
                                        <label for="subcategory_ids">Danh mục con <span class="text-danger">*</span></label>

                                        @php
                                            $selectedSubcategoryIds = collect(old('subcategory_ids', isset($product) ? $product->subcategories->pluck('id')->toArray() : []));
                                        @endphp

                                        <select name="subcategory_ids[]" id="subcategory_ids" class="form-control k_selectpicker"
                                            data-live-search="true" multiple data-actions-box="true" data-none-selected-text="-- Chọn danh mục con --">
                                            @foreach($categories as $category)
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach($category->subCategories ?? [] as $subCategory)
                                                        <option value="{{ $subCategory->id }}"
                                                            data-tokens="{{ $category->name }} {{ $subCategory->name }}"
                                                            {{ $selectedSubcategoryIds->contains($subCategory->id) ? 'selected' : '' }}>
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('subcategory_ids')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Brand Field -->
                                    <div class="form-group">
                                        <label for="brand_id" class="form-label mb-1">Thương hiệu <span class="text-danger">*</span></label>
                                        <select name="brand_id"
                                                id="brand_id"
                                                class="form-control k_selectpicker"
                                                data-live-search="true">
                                            <option value="">-- Chọn thương hiệu --</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Type Field -->
                                    <div class="form-group">
                                        <label for="type">Loại <span class="text-danger">*</span></label>
                                        <select name="type"
                                                id="type"
                                                class="form-control k_selectpicker"
                                                required>
                                            <option value="">Chọn loại</option>
                                            @foreach($ProductTypeEnumLabels as $key => $label)
                                                <option value="{{ $key }}"
                                                        {{ old('type') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status Field -->
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mr-3">Kích hoạt</label>
                                        <span class="k-switch">
                                            <label>
                                                <input type="checkbox" name="status" value="1" checked>
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
                                    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                                    <button type="reset" class="btn btn-secondary">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush
