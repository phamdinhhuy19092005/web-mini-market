@extends('backoffice.layouts.master')

@php
    $title = __('Tạo giỏ hàng');
    $breadcrumbs = [
        ['label' => __('Giỏ hàng')],
        ['label' => __('Tạo giỏ hàng')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__head k-portlet__head--lg">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Tạo giỏ hàng') }}</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.carts.store') }}" method="POST" class="k-form">
                    @csrf
                    <div class="k-portlet__body">
                        <!-- Thông tin khách hàng -->
                        <div class="k-portlet__body-section">
                            <h4 class="k-portlet__body-title">{{ __('Thông tin khách hàng') }}</h4>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="user_id">{{ __('Người dùng') }} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control k_selectpicker" data-live-search="true" >
                                        <option value="">{{ __('-- Chọn người dùng --') }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}
                                                    data-address-id="{{ $user->address_id ?? '' }}">
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="k-form__error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="address_id">{{ __('Địa chỉ giao hàng') }}</label>
                                    <input type="number" name="address_id" id="address_id" class="form-control"
                                           value="{{ old('address_id') }}" min="0">
                                    @error('address_id')
                                        <span class="k-form__error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin đơn hàng -->
                        <div class="k-portlet__body-section">
                            <h4 class="k-portlet__body-title">{{ __('Thông tin đơn hàng') }}</h4>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="currency_code">{{ __('Mã tiền tệ') }} <span class="text-danger">*</span></label>
                                    <select name="currency_code" id="currency_code" class="form-control k_selectpicker" required>
                                        <option value="VND" {{ old('currency_code', 'VND') == 'VND' ? 'selected' : '' }}>VND</option>
                                        <option value="USD" {{ old('currency_code') == 'USD' ? 'selected' : '' }}>USD</option>
                                        <option value="EUR" {{ old('currency_code') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                    </select>
                                    @error('currency_code')
                                        <span class="k-form__error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="order_id">{{ __('Mã đơn hàng liên kết') }}</label>
                                    <input type="number" name="order_id" id="order_id" class="form-control"
                                           value="{{ old('order_id') }}" min="0">
                                    @error('order_id')
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
                                                    data-image="{{ $inventory['image'] ?? '' }}"
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
                                <table class="table table-bordered table-hover" style="font-size: 12px">
                                    <thead style="font-size: 12px">
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
                                           value="{{ old('total_quantity', 0) }}" min="0" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="total_price">{{ __('Tổng giá') }}</label>
                                    <input type="number" name="total_price" id="total_price" class="form-control"
                                           value="{{ old('total_price', 0) }}" min="0" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">{{ __('Lưu giỏ hàng') }}</button>
                            <a href="{{ route('bo.web.carts.index') }}" class="btn btn-secondary">{{ __('Hủy') }}</a>
                        </div>
                    </div>
                </form>
            </div>
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

    let index = 0;

    const updateTotals = () => {
        let totalQuantity = 0;
        let totalPrice = 0;
        document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)').forEach(item => {
            const quantity = parseInt(item.querySelector('.item-quantity').value) || 0;
            const price = parseFloat(item.querySelector('.item-price').value) || 0;
            const total = quantity * price;
            item.querySelector('.item-total').value = total.toFixed(2);
            totalQuantity += quantity;
            totalPrice += total;
        });
        document.getElementById('total_quantity').value = totalQuantity;
        document.getElementById('total_price').value = totalPrice.toFixed(2);
    };

    // Kích hoạt nút chọn khi có sản phẩm được chọn
    const productSelector = document.getElementById('product-selector');
    productSelector.addEventListener('change', () => {
        const addButton = document.getElementById('add-cart-item');
        addButton.disabled = !productSelector.value;
    });

    // Thêm sản phẩm vào bảng
    document.getElementById('add-cart-item').addEventListener('click', () => {
        const selectedOption = productSelector.options[productSelector.selectedIndex];
        if (!selectedOption.value || !selectedOption.getAttribute('data-price')) {
            alert('Vui lòng chọn sản phẩm có giá hợp lệ.');
            return;
        }

        const wrapper = document.getElementById('cart-items-wrapper');
        const template = document.getElementById('cart-item-template');
        const clone = template.cloneNode(true);
        clone.classList.remove('d-none');

        const price = selectedOption.getAttribute('data-price');
        const image = selectedOption.getAttribute('data-image');
        const title = selectedOption.getAttribute('data-title');
        const stock = selectedOption.getAttribute('data-stock');

        clone.querySelectorAll('input').forEach(el => {
            el.name = el.name.replace(/__INDEX__/, index);
            if (el.classList.contains('item-quantity')) {
                el.value = 1;
                el.setAttribute('max', stock);
            } else if (el.classList.contains('item-price')) {
                el.value = price ? parseFloat(price).toFixed(2) : '';
            } else if (el.classList.contains('item-product-id')) {
                el.value = selectedOption.value;
            }
        });

        clone.querySelector('.item-id').textContent = selectedOption.value;
        clone.querySelector('.item-image').src = image || 'https://via.placeholder.com/50';
        clone.querySelector('.item-title').textContent = title;
        clone.querySelector('.item-total').value = price ? parseFloat(price).toFixed(2) : '';

        wrapper.appendChild(clone);
        clone.querySelector('.item-quantity').addEventListener('input', updateTotals);

        index++;
        productSelector.selectedIndex = 0;
        document.getElementById('add-cart-item').disabled = true;
        updateTotals();
    });

    // Xóa sản phẩm
    document.getElementById('cart-items-wrapper').addEventListener('click', (e) => {
        if (e.target.closest('.remove-item')) {
            e.target.closest('.cart-item').remove();
            updateTotals();
        }
    });

    // Tự động điền địa chỉ khi chọn người dùng
    document.getElementById('user_id').addEventListener('change', (e) => {
        const userId = e.target.value;
        const selectedOption = e.target.options[e.target.selectedIndex];
        const addressId = selectedOption.getAttribute('data-address-id') || '';
        document.getElementById('address_id').value = addressId;

        if (userId && addressId === '') {
            fetch(`/api/users/${userId}/address`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('address_id').value = data.address_id || '';
            })
            .catch(error => {
                console.error('Lỗi khi lấy địa chỉ:', error);
                document.getElementById('address_id').value = '';
            });
        }
    });

    document.querySelector('.k-form').addEventListener('submit', (e) => {
        const template = document.getElementById('cart-item-template');
        if (template) {
            template.remove();
        }
    });

    updateTotals();
});
</script>
@endpush
