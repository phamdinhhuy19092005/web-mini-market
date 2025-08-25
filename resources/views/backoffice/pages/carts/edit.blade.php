@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa giỏ hàng');
    $breadcrumbs = [
        ['label' => __('Giỏ hàng')],
        ['label' => __('Chỉnh sửa giỏ hàng')],
    ];
    $totalQuantity = $cart->items->sum('quantity');
    $totalPrice = $cart->items->sum(fn($item) => $item->price * $item->quantity);
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">
                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Chỉnh sửa giỏ hàng') }}</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="k-form" action="{{ route('bo.web.carts.update', $cart->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="k-portlet__body">
                            <!-- Thông tin khách hàng -->
                            <div class="k-portlet__body-section">
                                <h4 class="k-portlet__body-title">{{ __('Thông tin khách hàng') }}</h4>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="user_id">{{ __('Người dùng') }} <span class="text-danger">*</span></label>
                                        <select name="user_id" id="user_id" class="form-control k_selectpicker" data-live-search="true" required>
                                            <option value="">{{ __('-- Chọn người dùng --') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                        {{ old('user_id', $cart->user_id) == $user->id ? 'selected' : '' }}
                                                        data-address-id="{{ $user->address_id ?? '' }}">
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="k-form__error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Thông tin đơn hàng -->
                                    <div class="col-md-6 form-group">
                                        <label for="currency_code">{{ __('Mã tiền tệ') }} <span class="text-danger">*</span></label>
                                        <select name="currency_code" id="currency_code" class="form-control k_selectpicker" required>
                                            @foreach (['VND'] as $currency)
                                                <option value="{{ $currency }}"
                                                        {{ old('currency_code', $cart->currency_code) == $currency ? 'selected' : '' }}>
                                                    {{ $currency }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('currency_code')
                                            <span class="k-form__error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Danh sách sản phẩm -->
                            <div class="k-portlet__body-section">
                                <h4 class="k-portlet__body-title">{{ __('Danh sách sản phẩm') }}</h4>
                                <div class="form-group mb-4">
                                    <div class="d-flex align-items-center">
                                        <select id="product-selector" class="form-control k_selectpicker mr-2" data-live-search="true" style="max-width: 400px;">
                                            <option value="">{{ __('-- Chọn sản phẩm --') }}</option>
                                            @foreach ($inventories as $inventory)
                                                <option value="{{ $inventory['id'] }}"
                                                        data-price="{{ $inventory['offer_price'] ?? $inventory['sale_price'] }}"
                                                        data-image="{{ $inventory['image'] ?? asset('images/placeholder.png') }}"
                                                        data-title="{{ $inventory['title'] }}"
                                                        data-stock="{{ $inventory['stock_quantity'] ?? 999 }}">
                                                    {{ $inventory['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="add-cart-item" class="btn btn-success" disabled>
                                            <i class="la la-plus"></i> {{ __('Chọn') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Hình ảnh') }}</th>
                                                <th>{{ __('Sản phẩm') }}</th>
                                                <th>{{ __('Giá đơn vị') }}</th>
                                                <th>{{ __('Số lượng') }}</th>
                                                <th>{{ __('Tổng giá') }}</th>
                                                <th>{{ __('Hành động') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-items-wrapper">
                                            <tr id="cart-item-template" class="cart-item d-none">
                                                <td class="item-id"></td>
                                                <td><img src="" class="item-image" width="50" alt=""></td>
                                                <td class="item-title"></td>
                                                <td><input type="number" name="items[__INDEX__][price]" class="form-control item-price" step="0.01" min="0" readonly></td>
                                                <td>
                                                    <input type="hidden" name="items[__INDEX__][inventory_id]" class="item-product-id">
                                                    <input type="number" name="items[__INDEX__][quantity]" class="form-control item-quantity" value="1" min="1">
                                                </td>
                                                <td><input type="number" class="form-control item-total" step="0.01" min="0" readonly></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-icon remove-item" title="{{ __('Xóa sản phẩm') }}">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @foreach ($cart->items as $i => $item)
                                                <tr class="cart-item">
                                                    <td class="item-id">{{ $item->inventory_id }}</td>
                                                    <td><img src="{{ $item->inventory->image ?? asset('images/placeholder.png') }}" class="item-image" width="50" alt=""></td>
                                                    <td class="item-title">{{ $item->inventory->title }}</td>
                                                    <td>
                                                        <input type="number" name="items[{{ $i }}][price]" class="form-control item-price" value="{{ number_format($item->price, 2, '.', '') }}" step="0.01" min="0" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="items[{{ $i }}][inventory_id]" class="item-product-id" value="{{ $item->inventory_id }}">
                                                        <input type="number" name="items[{{ $i }}][quantity]" class="form-control item-quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->inventory->stock_quantity ?? 999 }}">
                                                    </td>
                                                    <td><input type="number" class="form-control item-total" value="{{ number_format($item->price * $item->quantity, 2, '.', '') }}" step="0.01" min="0" readonly></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-icon remove-item" title="{{ __('Xóa sản phẩm') }}">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tổng quan -->
                            <div class="k-portlet__body-section">
                                <h4 class="k-portlet__body-title">{{ __('Tổng quan') }}</h4>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="total_quantity">{{ __('Tổng số lượng') }}</label>
                                        <input type="number" name="total_quantity" id="total_quantity" class="form-control"
                                               value="{{ old('total_quantity', $totalQuantity) }}" min="0" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="total_price">{{ __('Tổng giá') }}</label>
                                        <input type="number" name="total_price" id="total_price" class="form-control"
                                               value="{{ old('total_price', number_format($totalPrice, 2, '.', '')) }}" min="0" step="0.01" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('Hủy') }}</button>
                        </div> --}}
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <style>
    .k-portlet__body-section {
        border-bottom: 1px solid #ebedf2;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    .k-portlet__body-title {
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 15px;
        color: #36435c;
    }
    .k-form__error {
        color: #fd397a;
        font-size: 0.9rem;
        margin-top: 5px;
        display: block;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table .item-image {
        border-radius: 4px;
        object-fit: cover;
    }
    .btn-icon i {
        font-size: 1rem;
    }
    </style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    $('.k_selectpicker').selectpicker();

    let index = document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)').length;

    const productSelector = document.getElementById('product-selector');
    const addButton = document.getElementById('add-cart-item');

    productSelector.addEventListener('change', () => {
        addButton.disabled = !productSelector.value;
    });

    const updateTotals = () => {
        let totalQuantity = 0;
        let totalPrice = 0;
        document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)').forEach(item => {
            const quantityInput = item.querySelector('.item-quantity');
            const price = parseFloat(item.querySelector('.item-price').value) || 0;
            let quantity = parseInt(quantityInput.value) || 0;
            const maxQuantity = parseInt(quantityInput.getAttribute('max')) || 999;

            if (quantity > maxQuantity) {
                quantity = maxQuantity;
                quantityInput.value = maxQuantity;
                alert('Số lượng vượt quá tồn kho.');
            }

            const total = quantity * price;
            item.querySelector('.item-total').value = total.toFixed(2);
            totalQuantity += quantity;
            totalPrice += total;
        });
        document.getElementById('total_quantity').value = totalQuantity;
        document.getElementById('total_price').value = totalPrice.toFixed(2);
    };

    addButton.addEventListener('click', () => {
        const selectedOption = productSelector.options[productSelector.selectedIndex];
        if (!selectedOption.value || !selectedOption.getAttribute('data-price')) {
            alert('Vui lòng chọn sản phẩm hợp lệ.');
            return;
        }

        const exists = document.querySelector(`.item-product-id[value="${selectedOption.value}"]`);
        if (exists) {
            alert('Sản phẩm đã có trong giỏ hàng.');
            return;
        }

        const wrapper = document.getElementById('cart-items-wrapper');
        const template = document.getElementById('cart-item-template');
        const clone = template.cloneNode(true);
        clone.classList.remove('d-none');

        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const image = selectedOption.getAttribute('data-image');
        const title = selectedOption.getAttribute('data-title');
        const stock = parseInt(selectedOption.getAttribute('data-stock')) || 999;

        clone.querySelectorAll('input').forEach(el => {
            el.name = el.name.replace(/__INDEX__/, index);
            if (el.classList.contains('item-quantity')) {
                el.value = 1;
                el.setAttribute('max', stock);
                el.addEventListener('input', updateTotals);
            } else if (el.classList.contains('item-price')) {
                el.value = price.toFixed(2);
            } else if (el.classList.contains('item-product-id')) {
                el.value = selectedOption.value;
            }
        });

        clone.querySelector('.item-id').textContent = selectedOption.value;
        clone.querySelector('.item-image').src = image;
        clone.querySelector('.item-title').textContent = title;
        clone.querySelector('.item-total').value = price.toFixed(2);

        clone.querySelector('.remove-item').addEventListener('click', () => {
            clone.remove();
            updateTotals();
        });

        wrapper.appendChild(clone);
        index++;
        productSelector.selectedIndex = 0;
        addButton.disabled = true;
        updateTotals();
    });

    document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)').forEach(item => {
        item.querySelector('.item-quantity').addEventListener('input', updateTotals);
        item.querySelector('.remove-item').addEventListener('click', () => {
            item.remove();
            updateTotals();
        });
    });

    updateTotals();
});
</script>
@endpush
