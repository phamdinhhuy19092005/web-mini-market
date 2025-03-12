@extends('backoffice.layouts.master')

@php
$title = __('Manage Products');

$breadcrumbs = [
    [
        'label' => __('Products'),
    ],
    [
        'label' => __('Categories'),
    ],
    [
        'label' => __('Manage Products'),
    ],
];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title,'items' => $breadcrumbs])
@endcomponent


<!-- begin:: Content Body -->
@section('content_body')
<div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
    <div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
	<form id="form_store_product" method="POST" action="http://127.0.0.1:8003/bo/products" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="OveY6whv7c1kZmQvCZJPdnHQsAz4oXiJZMfr1fBA">
        <div class="k-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand d-flex">
                <li class="nav-item">
                    <a class="nav-link show active" data-toggle="tab" href="#Tag_General_Information">
                        Thông tin chung
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Tag_Connect_Information">
                        Thông tin liên kết
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane show active" id="Tag_General_Information">
                <div class="row">
                    <div class="col-md-8">
                        <div class="k-portlet">
                            <div class="k-portlet__head">
                                <div class="k-portlet__head-label">
                                    <h3 class="k-portlet__head-title">Thông tin chung</h3>
                                </div>
                            </div>
                            <div class="k-portlet__body">
                                <div class="form-group">
                                    <label for="">Tên *</label>
                                    <input type="text" name="name" value="" class="form-control " placeholder="Nhập tên" data-reference-slug="slug" required="">
                                                                    </div>

                                <div class="form-group">
                                    <label for="">Đường dẫn *</label>
                                    <input type="text" name="slug" value="" class="form-control " placeholder="Nhập [SEO] tiêu đề" required="">
                                                                    </div>

                                <div class="form-group">
                                    <label for="">SKU Sản phẩm *</label>
                                    <div class="input-group">
                                        <input id="code" type="text" name="code" value="" class="form-control " placeholder="Nhập Code" required="">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" data-generate="" data-generate-length="10" data-generate-ref="#code" data-generate-uppercase="true" type="button">Generate Code</button>
                                        </div>
                                    </div>

                                            </div>

                                <div class="form-group">
                                    <label>Hình ảnh *</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="upload_image_custom position-relative">
                                                <input type="text" data-image-ref-path="primary" data-image-ref-index="0" class="form-control image_primary_image_url" name="primary_image[path]" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
                                                <div data-image-ref-wrapper="primary" data-image-ref-index="0" class="d-none w-100 position-absolute d-none" style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                    <div class="d-flex align-items-center h-100">
                                                        <img data-image-ref-img="primary" data-image-ref-index="0" src="" alt="Image preview" class="mr-2" style="height: 100%; width: 100px;">
                                                        <span data-image-ref-delete="primary" data-image-ref-index="0" style="font-size: 16px; cursor: pointer;">×</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control ">
                                                                                    </div>
                                        <div class="col-md-6">
                                            <div class="image_primary_image_review">
                                                <div data-image-ref-review-wrapper="primary" data-image-ref-index="0" class="d-none" style="width: 100px; height: 100px; border: 1px solid #ccc;">
                                                    <img data-image-ref-review-img="primary" data-image-ref-index="0" style="width: 100%; height: 100%;" src="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Bộ sưu tập ảnh</label>
                                    <div class="media_image_repeater">
                                        <div data-repeater-list="media[image]">
                                            <div data-repeater-item="" class="k-repeater__item">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_image_custom position-relative">
                                                            <input type="text" data-image-ref-path="media" data-image-ref-index="0" class="form-control media_image_path" name="media[image][0][path]" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;" value="">
                                                            <div data-image-ref-wrapper="media" data-image-ref-index="0" class="d-none w-100 position-absolute d-none" style="top: 50%; left: 4px; transform: translateY(-50%); height: 90%; background-color: #fff;">
                                                                <div class="d-flex align-items-center h-100">
                                                                    <img data-image-ref-img="media" data-image-ref-index="0" src="" alt="Image preview" class="mr-2" style="height: 100%; width: 100px;">
                                                                    <span data-image-ref-delete="media" data-image-ref-index="0" style="font-size: 16px; cursor: pointer;">×</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <div class="image_media_image_review mr-1">
                                                                <div data-image-ref-review-wrapper="media" data-image-ref-index="0" class="d-none" style="width: 100px; height: 100px; border: 1px solid #ccc;">
                                                                    <img data-image-ref-review-img="media" data-image-ref-index="0" style="width: 100%; height: 100%;" src="" alt="">
                                                                </div>
                                                            </div>
                                                            <button type="button" data-repeater-delete="" class="btn btn-secondary btn-icon h-100 mr-2" style="width: 30px!important; height: 30px!important;">
                                                                <i class="la la-close"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="k-separator k-separator--space-sm"></div>
                                            </div>
                                        </div>
                                        <div class="k-repeater__add-data">
                                            <span data-repeater-create="" class="btn btn-info btn-sm">
                                                <i class="la la-plus"></i> Thêm
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Video</label>
                                    <div class="video-media-item">
                                        <input type="text" name="media[video][0][path]" value="" class="form-control " placeholder="Nhập đường dẫn video">
                                        <input type="hidden" name="media[video][0][order]" value="1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" class="form-control" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="k-portlet">
                            <div class="k-portlet__head">
                                <div class="k-portlet__head-label">
                                    <h3 class="k-portlet__head-title">Thông tin phân loại</h3>
                                </div>
                            </div>
                            <div class="k-portlet__body">
                                <div class="form-group">
                                    <label>Danh mục *</label>
                                    <div class="dropdown bootstrap-select show-tick form-control k_" data-original-title="" title="">
                                        <select name="categories[]" title="-- Chọn danh mục --" class="form-control k_selectpicker" data-size="5" multiple="" required="" data-live-search="true" tabindex="-98">

                                        </select>
                                        <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn danh mục --" aria-expanded="false">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">-- Chọn danh mục --</div>
                                            </div>
                                            <span class="bs-caret">
                                                <span class="caret"></span>
                                            </span>
                                        </button>
                                        <div class="dropdown-menu" style="max-height: 298px; overflow: hidden; min-width: 307px;">
                                            <div class="bs-searchbox">
                                                <input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search">
                                            </div>
                                            <div class="inner show" tabindex="-1" aria-expanded="false" style="max-height: 214px; overflow-y: auto;">
                                                <ul class="dropdown-menu inner show">
                                                    <li class="dropdown-header optgroup-1">

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Loại sản phẩm *</label>
                                    <div class="dropdown bootstrap-select form-control k_" data-original-title="" title="">
                                        <select name="type" title="-- Chọn loại sản phẩm --" class="form-control k_selectpicker" tabindex="-98">
                                            <option class="bs-title-option" value="">-- Chọn loại sản phẩm --</option>

                                        </select>
                                        <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn loại sản phẩm --">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">-- Chọn loại sản phẩm --</div>
                                            </div>
                                            <span class="bs-caret">
                                                <span class="caret"></span>
                                            </span>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" tabindex="-1">
                                                <ul class="dropdown-menu inner show"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Thương hiệu</label>
                                    <input type="text" class="form-control " name="branch" placeholder="Nhập tên thương hiệu" value="">
                                                                    </div>

                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Hoạt động</label>
                                    <div class="col-3">
                                        <span class="k-switch">
                                            <label>
                                                <input type="checkbox" checked="" value="1" name="status">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="Tag_Connect_Information">
                <div class="k-portlet">
                    <div class="k-portlet__body">
                        <div class="form-group">
                            <label>Sản phẩm liên quan</label>
                            <div class="dropdown bootstrap-select show-tick form-control k_ Related_Product_Selector" data-original-title="" title="">
                                <select data-actions-box="true" name="suggested_relationships[inventories][]" title="-- Sản phẩm liên quan --" data-size="5" data-live-search="true" class="form-control k_selectpicker Related_Product_Selector" multiple="" data-selected-text-format="count > 5" tabindex="-98">
                                </select>
                                <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Sản phẩm liên quan --">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">-- Sản phẩm liên quan --</div>
                                    </div>
                                    <span class="bs-caret">
                                        <span class="caret"></span>
                                    </span>
                                </button>
                                <div class="dropdown-menu ">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                    <div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block">
                                        <button type="button" class="actions-btn bs-select-all btn btn-light">Select All</button>
                                        <button type="button" class="actions-btn bs-deselect-all btn btn-light">Deselect All</button>
                                    </div></div><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group Related_Product_Allowed_Holder mb-0 mt-2 d-none">
                                <div class="Related_Product_Holder_Content"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Bài viết liên quan</label>
                            <div class="dropdown bootstrap-select show-tick form-control k_ Related_Post_Selector" data-original-title="" title="">
                                <select data-actions-box="true" name="linked_posts[]" title="-- Bài viết liên quan --" data-size="5" data-live-search="true" class="form-control k_selectpicker Related_Post_Selector" multiple="" data-selected-text-format="count > 5" tabindex="-98">
                                    <button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Bài viết liên quan --">
                                        <div class="filter-option"><div class="filter-option-inner">-- Bài viết liên quan --</div></div><span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div><div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn btn-light">Select All</button><button type="button" class="actions-btn bs-deselect-all btn btn-light">Deselect All</button></div></div><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                            <div class="form-group Related_Post_Allowed_Holder mb-0 mt-2 d-none">
                                <div class="Related_Post_Holder_Content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="k-form__actions d-flex justify-content-start">
                    <button type="redirect" class="btn btn-secondary mr-2">Huỷ</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
												<!-- end:: Content Body -->
					</div>
<!-- end:: Content Body -->
@endsection
