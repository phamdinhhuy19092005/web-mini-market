@extends('backoffice.layouts.master')

@php
    $title = __('Kho sản phẩm');
    $breadcrumbs = [
        ['label' => $title],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Danh sách kho sản phẩm') }}</h3>
                    </div>

                    <div class="k-portlet__head-toolbar">
                        <a href="{{ route('bo.web.products.create') }}" class="btn btn-primary btn-bold btn-upper btn-font-sm" data-toggle="modal" data-target="#productSelectionModal">
                            <i class="flaticon2-add-1"></i> {{ __('Tạo sản phẩm vào kho') }}
                        </a>
                    </div>

                </div>

                <div class="k-portlet__body k-portlet__body--fit p-4">
                    <table id="table_inventories_index" data-group-column="2" class="table table-bordered datatable" data-request-url="{{ route('bo.api.inventories.index') }}" data-searching="true">
                        <thead>
                            <tr>
                                <th class="all" data-property="id">ID</th>
                                <th class="all" data-property="image" data-render-callback="renderImageColumn" data-width="100">{{ __('Hình ảnh') }}</th>
                                <th class="all" data-property="product.code">{{ __('SKU Sản phẩm') }}</th>
                                <th class="all" data-property="init_sold_count">{{ __('Đã bán ảo') }}</th>
                                <th class="all" data-property="sold_count">{{ __('Đã bán thật') }}</th>
                                <th class="all" data-property="status_name" data-render-callback="renderStatusColumn">{{ __('Trạng thái') }}</th>
                                <th class="all" data-property="purchase_price">{{ __('Giá mua') }}</th>
                                <th class="all" data-property="sale_price">{{ __('Giá bán') }}</th>
                                <th class="all" data-property="offer_price" data-render-callback="renderCallbackOfferPrice">{{ __('Giá khuyến mãi') }}</th>
                                <th class="none" data-property="title">{{ __('Tiêu đề') }}</th>
                                <th class="none" data-property="unit_type">{{ __('Loại đơn vị') }}</th>
                                <th class="none" data-property="stock_quantity">{{ __('Số lượng') }}</th>
                                <th class="none" data-property="created_by.name">{{ __('Người tạo') }}</th>
                                <th class="none" data-property="updated_by.name">{{ __('Người cập nhật') }}</th>
                                <th class="none" data-property="created_at">{{ __('Ngày tạo') }}</th>
                                <th class="none" data-property="updated_at">{{ __('Ngày cập nhật') }}</th>
                                <th class="datatable-action" data-property="actions" data-render-callback="renderActions">{{ __('Hành động') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="productSelectionModal" tabindex="-1" role="dialog" aria-labelledby="productSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Chọn sản phẩm') }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <select name="product_id" id="product_id" class="form-control k_selectpicker" data-live-search="true" required>
                    <option value="">-- {{ __('Chọn sản phẩm') }} --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-type="{{ strtolower(trim($product->type_name)) }}">
                            {{ $product->name }} ({{ $product->type_name }})
                        </option>
                    @endforeach
                </select>

                <div class="has_attributes d-none mt-3">
                    @foreach ($attributes as $attribute)
                        <div class="form-group attribute-item d-none">
                            <label>{{ $attribute->name }}</label>
                            <select name="attribute_values[{{ $attribute->id }}][]" class="form-control k_selectpicker" multiple>
                                @foreach ($attribute->attributeValues->sortBy('order') as $value)
                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
                <button class="btn btn-primary" id="selectProductBtn">{{ __('Xác nhận') }}</button>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@component('backoffice.partials.datatable') @endcomponent

@push('js_pages')
<script>
    function renderCallbackOfferPrice(data) {
        if (!data || parseFloat(data) === 0) {
            return `<span class="text-muted">-</span>`;
        }
        let formattedPrice = parseFloat(data).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        return `<span class="text-success font-weight-bold">${formattedPrice}</span>`;
    }

    $(document).ready(function () {
        $('.k_selectpicker').selectpicker();

        $('#product_id').on('change', function () {
            const selected = $(this).find(':selected');
            const productType = selected.data('type');

            $('.has_attributes, .attribute-item').addClass('d-none');
            if (productType === 'variable') {
                $('.has_attributes').removeClass('d-none');
                $('.attribute-item').each(function () {
                    $(this).removeClass('d-none').find('.k_selectpicker').selectpicker('refresh');
                });
            }
        });

        $('#selectProductBtn').on('click', function () {
            const productId = $('#product_id').val();
            const productType = $('#product_id option:selected').data('type');

            if (!productId) {
                alert('{{ __("Vui lòng chọn một sản phẩm") }}');
                return;
            }

            if (productType === 'simple') {
                location.href = '{{ route("bo.web.inventories.create") }}?product_id=' + productId;
            } else if (productType === 'variable') {
                let attributeValues = {};
                let selectedAny = false;

                $('.attribute-item:visible select').each(function () {
                    const attrId = $(this).attr('name').match(/\d+/)[0];
                    const values = $(this).val();
                    if (values && values.length > 0) {
                        attributeValues[`attribute_values[${attrId}][]`] = values;
                        selectedAny = true;
                    }
                });

                if (!selectedAny) {
                    alert('{{ __("Vui lòng chọn ít nhất một giá trị thuộc tính") }}');
                    return;
                }

                location.href = '{{ route("bo.web.inventories.create") }}?' + $.param({ product_id: productId, ...attributeValues });
            } else {
                alert('{{ __("Loại sản phẩm không hợp lệ") }}');
            }
        });
    });
</script>
@endpush
