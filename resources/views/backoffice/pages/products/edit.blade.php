@extends('backoffice.layouts.master')

@php
    $title = __('Edit Product');

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


@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent


<!-- begin:: Content Body -->
@section('content_body')
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
<!-- begin:: Content Body -->
<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
	<form id="form_store_product" method="POST" action="http://127.0.0.1:8003/bo/products/110" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="fXLrxLQZvubN6GrJ97HR9FjtjBYVR5P89nNrfzDT">        <input type="hidden" name="_method" value="PUT">
        <div class="product-preview mb-3">
            <div class="row">
                <div class="col-md-2">
                    <img src="" alt="" style="width: 100%; height: auto;">
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" disabled="" value="">
                    </div>

                    <div class="form-group">
                        <label for="">SKU</label>
                        <input type="text" class="form-control" disabled="" value="">
                    </div>
                </div>
            </div>
        </div>

        <hr>


        <div class="k-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line nav-tabs-line-brand d-flex">
                <li class="nav-item">
                    <a class="nav-link show active" data-toggle="tab" href="#Tag_General_Information">
                        Thông tin chung
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Tag_Detail_Information">
                        Thông tin chi tiết
                    </a>
                </li>

                                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Tag_Inventories">
                        Sản phẩm tồn kho
                        <span>(0)</span>
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
                    <div class="col-md-12">
                        <div class="k-portlet">
                            <div class="k-portlet__body">
                                <div class="form-group">
                                    <label for="">Tên *</label>
                                    <input type="text" name="name" value="" class="form-control " data-reference-slug="slug" placeholder="Nhập tên" required="">
                                                                    </div>

                                <div class="form-group">
                                    <label for="">Đường dẫn *</label>
                                    <input type="text" name="slug" value="" class="form-control " placeholder="Nhập [SEO] tiêu đề" required="">
                                                                    </div>

                                <div class="form-group">
                                    <label for="">SKU Sản phẩm *</label>
                                    <div class="input-group">
                                        <input type="hidden" name="code" value="">
                                        <input id="code" type="text" value="" class="form-control " placeholder="Nhập Code" required="" disabled="">
                                    </div>
                                                                    </div>

                                <div class="form-group">
                                    <label>Loại sản phẩm *</label>
                                    <div class="dropdown bootstrap-select form-control k_" data-original-title="" title=""><select title="-- Chọn loại sản phẩm --" name="type" class="form-control k_selectpicker" tabindex="-98"><option class="bs-title-option" value="">-- Chọn loại sản phẩm --</option>
                                                                                <option value="1" selected="">Simple</option>
                                                                                <option value="2">Variable</option>
                                                                            </select><button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" title="Simple"><div class="filter-option"><div class="filter-option-inner">Simple</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                                                                    </div>

                                <div class="form-group">
                                    <label>Danh mục *</label>
                                    <div class="dropdown bootstrap-select show-tick form-control k_" data-original-title="" title=""><select name="categories[]" title="-- Chọn danh mục --" class="form-control k_selectpicker" data-size="5" multiple="" required="" data-live-search="true" tabindex="-98">
                                                                            </select><button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Chọn danh mục --"><div class="filter-option"><div class="filter-option-inner">-- Chọn danh mục --</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                                                                    </div>

                                <div class="form-group">
                                    <label>Thương hiệu</label>
                                    <input type="text" class="form-control " name="branch" placeholder="Nhập tên thương hiệu" value="branch">
                                                                    </div>

                                <div class="form-group">
                                    <label>Hoạt động</label>
                                    <div>
                                        <span class="k-switch k-switch--icon">
                                            <label>
                                                <input type="checkbox" checked="" name="status">
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
            <div class="tab-pane" id="Tag_Detail_Information">
                <div class="row">
                    <div class="col-md-12">
                        <div class="k-portlet">
                            <div class="k-portlet__body">
                                <div class="form-group">
                                    <label>Hình ảnh *</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="upload_image_custom position-relative">
                                                <input type="text" data-image-ref-path="primary" data-image-ref-index="0" class="form-control image_primary_image_url" name="primary_image[path]" value="" placeholder="Tải ảnh lên hoặc nhập URL ảnh" style="padding-right: 104px;">
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
                                                <div data-image-ref-review-wrapper="primary" data-image-ref-index="0" class="" style="width: 100px; height: 100px; border: 1px solid #ccc;">
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
                                    <div class="content-editor">
                                    <label for="description">Mô tả</label>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        <div class="tab-pane" id="Tag_Inventories">
                <div class="row">
                    <div class="col-md-12">
                        <div class="k-portlet">
                            <div class="k-portlet__body">
                                <div id="table_inventories_index_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-6 text-left"><div id="table_inventories_index_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="table_inventories_index"></label></div></div><div class="col-sm-6 text-right"><div class="dt-buttons btn-group"></div></div></div><div class="row"><div class="col-sm-12"><table id="table_inventories_index" data-searching="true" data-request-url="http://127.0.0.1:8003/bo/api/v1/inventories?product_id=110" class="datatable table table-striped table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid" aria-describedby="table_inventories_index_info" style="width: 0px;">
                                    <thead>
                                        <tr role="row"><th data-property="id" class="id sorting_desc" tabindex="0" aria-controls="table_inventories_index" rowspan="1" colspan="1" style="width: 0px;" aria-label="ID: activate to sort column ascending" aria-sort="descending">ID</th><th data-orderable="false" data-property="image" data-render-callback="renderCallbackImage" class="image sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label="Hình ảnh">Hình ảnh</th><th data-orderable="false" data-badge="" data-name="status" data-property="status_name" class="status sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label="Trạng thái">Trạng thái</th><th data-orderable="false" data-badge="" data-name="display_on_frontend" data-property="display_on_frontend_name" class="display_on_frontend sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label="Hiển Thị FE">Hiển Thị FE</th><th data-orderable="false" data-badge="" data-name="allow_frontend_search" data-property="allow_frontend_search_name" class="allow_frontend_search sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label="Tìm kiếm FE">Tìm kiếm FE</th><th data-property="purchase_price" class="purchase_price sorting" tabindex="0" aria-controls="table_inventories_index" rowspan="1" colspan="1" style="width: 0px;" aria-label="Giá mua: activate to sort column ascending">Giá mua</th><th data-property="sale_price" class="sale_price sorting" tabindex="0" aria-controls="table_inventories_index" rowspan="1" colspan="1" style="width: 0px;" aria-label="Giá bán: activate to sort column ascending">Giá bán</th><th data-property="offer_price" data-render-callback="renderCallbackOfferPrice" class="offer_price sorting" tabindex="0" aria-controls="table_inventories_index" rowspan="1" colspan="1" style="width: 0px;" aria-label="Giá khuyến mãi: activate to sort column ascending">Giá khuyến mãi</th><th data-property="sold_count" class="sold_count sorting" tabindex="0" aria-controls="table_inventories_index" rowspan="1" colspan="1" style="width: 0px;" aria-label="Đã bán: activate to sort column ascending">Đã bán</th><th class="datatable-action actions sorting_disabled" data-property="actions" data-action-icon-pack="{&quot;fe_link&quot;:&quot;<i class=\&quot;flaticon2-link-programing-symbol-of-interface\&quot;></i>&quot;}" rowspan="1" colspan="1" style="width: 0px;" aria-label="Hành động">Hành động</th></tr>
                                    </thead>
                                    <tbody>

                                    <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty">No data available in table</td></tr></tbody>
                                </table><div id="table_inventories_index_processing" class="dataTables_processing card" style="display: none;">Processing...</div></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="table_inventories_index_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-7 dataTables_pager"><div class="dataTables_length" id="table_inventories_index_length"><label>Show <select name="table_inventories_index_length" aria-controls="table_inventories_index" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div class="dataTables_paginate paging_simple_numbers" id="table_inventories_index_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="table_inventories_index_previous"><a href="#" aria-controls="table_inventories_index" data-dt-idx="0" tabindex="0" class="page-link"><i class="la la-angle-left"></i></a></li><li class="paginate_button page-item next disabled" id="table_inventories_index_next"><a href="#" aria-controls="table_inventories_index" data-dt-idx="1" tabindex="0" class="page-link"><i class="la la-angle-right"></i></a></li></ul></div></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="Tag_Connect_Information">
                <div class="row">
                    <div class="col-md-12">
                        <div class="k-portlet">
                            <div class="k-portlet__body">
                                <div class="form-group">
                                    <label>Sản phẩm liên quan</label>
                                    <div class="dropdown bootstrap-select show-tick form-control k_ Related_Product_Selector" data-original-title="" title=""><select data-actions-box="true" name="suggested_relationships[inventories][]" title="-- Sản phẩm liên quan --" data-size="5" data-live-search="true" class="form-control k_selectpicker Related_Product_Selector" multiple="" data-selected-text-format="count > 5" tabindex="-98">

                                                                                <option data-tokens="1 | Bơ thực vật nguyên chất Youmy xuất xứ Indonesia 100% tự nhiên [1Kg] | XNA9DF3CAK-VN2TG" data-product-id="1" data-product-name="Bơ thực vật nguyên chất Youmy xuất xứ Indonesia 100% tự nhiên [1Kg]" value="1">Bơ thực vật nguyên chất Youmy xuất xứ Indonesia 100% tự nhiên [1Kg]</option>
                                                                            </select><button type="button" class="btn dropdown-toggle bs-placeholder btn-light" data-toggle="dropdown" title="-- Sản phẩm liên quan --"><div class="filter-option"><div class="filter-option-inner">-- Sản phẩm liên quan --</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div><div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn btn-light">Select All</button><button type="button" class="actions-btn bs-deselect-all btn btn-light">Deselect All</button></div></div><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                                    <div class="form-group Related_Product_Allowed_Holder mb-0 mt-2 d-none">
                                        <div class="Related_Product_Holder_Content"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Bài viết liên quan</label>
                                    <div class="dropdown bootstrap-select show-tick form-control k_ Related_Post_Selector" data-original-title="" title="">
                                        <select data-actions-box="true" name="linked_posts[]" title="-- Bài viết liên quan --" data-size="5" data-live-search="true" class="form-control k_selectpicker Related_Post_Selector" multiple="" data-selected-text-format="count > 5" tabindex="-98">
                                        </select>
                                        <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" title="">
                                            <div class="filter-option">
                                                <div class="filter-option-inner"></div>
                                            </div><span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div><div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn btn-light">Select All</button><button type="button" class="actions-btn bs-deselect-all btn btn-light">Deselect All</button></div></div><div class="inner show" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                                    <div class="form-group Related_Post_Allowed_Holder mb-0 mt-2">
                                        <div class="Related_Post_Holder_Content">
                                            <button type="button" title="Remove" class="Related_Post_Badge_Selected btn btn-sm btn-outline-brand btn-primary btn-right-icon mr-3 mb-3" data-id="4" data-name="6JSTE - Sử dụng nến trong trang trí nhà cửa"><span class="bonus-content">6JSTE - Sử dụng nến trong trang trí nhà cửa - 4</span><i class="la la-close"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="row">
            <div class="col-md-12">
                <div class="k-portlet__foot">
                    <div class="k-form__actions d-flex justify-content-start">
                        <button type="redirect" class="btn btn-secondary mr-2">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
       </div>
    </form>
</div>
<!-- end:: Content Body -->
</div>
@endsection
