@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa Sản phẩm');
    $breadcrumbs = [
        ['label' => __('Kho sản phẩm')],
        ['label' => __('Sản phẩm')],
        ['label' => __('Chỉnh sửa Sản phẩm')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-portlet">
        <div class="k-portlet__body">
            <div class="row">
                <div class="col-md-3">
                    
                        <div class="mt-2">
                            <img class="img-fluid image-preview" style="max-width: 150px; display: {{ $product->primary_image ? 'block' : 'none' }};" src="{{ $product->primary_image ?? '' }}" alt="Image preview">
                        </div>
                        @error('image.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                   
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Nhập tên sản phẩm" autocomplete="off"
                            value="{{ old('name', $product->name) }}" disabled>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="code">SKU sản phẩm <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="code" type="text" name="code" class="form-control"
                                placeholder="Nhập mã sản phẩm" disabled
                                value="{{ old('code', $product->code) }}">
                        </div>
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bo.web.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Left column --}}
                        <div class="col-md-8">
                            <div class="k-portlet">
                                <div class="k-portlet__head">
                                    <div class="k-portlet__head-label">
                                        <h3 class="k-portlet__head-title">Thông tin chính</h3>
                                    </div>
                                </div>
                                <div class="k-portlet__body">
                                    {{-- Name --}}
                                    <div class="form-group">
                                        <label for="name">Tên <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" autocomplete="off"
                                            value="{{ old('name', $product->name) }}" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Slug --}}
                                    <div class="form-group">
                                        <label for="slug">Đường dẫn URL</label>
                                        <input type="text"
                                            name="slug"
                                            id="slug"
                                            class="form-control"
                                            placeholder="Nhập đường dẫn URL"
                                            autocomplete="off"
                                            value="{{ old('slug', $product->slug) }}">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Code --}}
                                    <div class="form-group">
                                        <label for="code">SKU sản phẩm <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="code" type="text" name="code" class="form-control" disabled value="{{ old('code', $product->code) }}">
                                            <div class="input-group-append">
                                                <button class="btn" type="button"
                                                    style="background-color: #e83e8c; color: white; border-color: #e83e8c;"
                                                    data-generate-ref="#code" data-generate-uppercase="true">
                                                    <i class="fas fa-lock text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="primary-image-file" class="form-label">Hình ảnh chính</label>
                                        <div class="input-group">
                                            <input type="text" 
                                                class="form-control image-url" 
                                                name="primary_image[path]" 
                                                placeholder="Tải ảnh lên hoặc nhập URL" 
                                                value="{{ old('primary_image.path', $product->primary_image) }}">
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
                                                style="max-width: 150px; display: display: {{ $product->primary_image ? 'block' : 'none' }};;" 
                                                src="{{ $product->primary_image ?? '' }}" 
                                                alt="Ảnh xem trước">
                                        </div>
                                        @error('primary_image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
                                        
                                        @php
                                            $media = is_string($product->media) ? json_decode($product->media, true) : ($product->media ?? []);
                                            $media = is_array($media) ? $media : [];
                                        @endphp

                                        @foreach ($media as $image)
                                            <div class="media-image-item form-group">
                                                <div class="d-flex">
                                                    <div class="input-group">
                                                        <input type="text" 
                                                            class="form-control image-url" 
                                                            name="media[path][]" 
                                                            value="{{ $image }}"
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
                                                        style="max-width: 150px; display: block;" 
                                                        src="{{ $image }}" 
                                                        alt="Ảnh xem trước">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- Nút Thêm ảnh -->
                                    <div class="form-group">
                                        <button type="button" id="add-media-image" class="btn btn-sm btn-secondary mt-2">
                                            + Thêm ảnh
                                        </button>
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <x-backoffice.content-editor
                                            id="product_description"
                                            name="description"
                                            :value="old('description', $product->description)"
                                            :cols="30"
                                            :rows="10"
                                            placeholder="Nhập mô tả..."
                                            disk="public"
                                            class=""
                                            :config="[]"
                                        />
                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right column --}}
                        <div class="col-md-4">
                            <div class="k-portlet">
                                <div class="k-portlet__head">
                                    <div class="k-portlet__head-label">
                                        <h3 class="k-portlet__head-title">Thông tin bổ sung</h3>
                                    </div>
                                </div>
                                <div class="k-portlet__body">
                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label for="category_ids">Danh mục <span class="text-danger">*</span></label>
                                        <select name="category_ids[]" id="category_ids" class="form-control k_selectpicker" data-live-search="true" data-none-selected-text="-- Chọn danh mục --" multiple required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ collect(old('category_ids', $product->categories->pluck('id')->toArray()))->contains($category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_ids') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- Brand --}}
                                    <div class="form-group">
                                        <label for="brand_id" class="form-label mb-1">Thương hiệu</label>
                                        <select name="brand_id" id="brand_id"
                                            class="form-control k_selectpicker" data-live-search="true">
                                            <option value="">-- Chọn thương hiệu --</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Type --}}
                                    <div class="form-group">
                                        <label for="type">Loại <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-control k_selectpicker" required>
                                            <option value="">Chọn loại</option>
                                            @foreach($ProductTypeEnumLabels as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('type', $product->type) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group d-flex align-items-center">
                                        <label class="mr-3">Kích hoạt</label>
                                        <span class="k-switch">
                                            <label>
                                                <input type="checkbox" name="status" value="1"
                                                    {{ old('status', $product->status) ? 'checked' : '' }}>
                                                <span></span>
                                            </label>
                                        </span>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
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
                <!-- End::Form -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
@endpush
