@extends('backoffice.layouts.master')

@php
    $title = __('Tạo giỏ hàng');
    $breadcrumbs = [
        ['label' => __('Giỏ hàng')],
        ['label' => __('Tạo')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <div class="k-portlet">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">{{ __('Tạo giỏ hàng') }}</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.carts.store') }}" method="POST">
                    @csrf
                    <div class="k-portlet__body">
                        <!-- Lựa chọn người dùng -->
                        <div class="form-group">
                            <label for="user_id">{{ __('Người dùng') }}</label>
                            <select name="user_id" id="user_id" class="form-control k_selectpicker">
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
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Địa chỉ giao hàng -->
                        <div class="form-group">
                            <label for="address_id">{{ __('Địa chỉ giao hàng (tùy chọn)') }}</label>
                            <input type="number" name="address_id" id="address_id" class="form-control" 
                                   value="{{ old('address_id') }}" min="0">
                            @error('address_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Mã tiền tệ -->
                        <div class="form-group">
                            <label for="currency_code">{{ __('Mã tiền tệ') }} <span class="text-danger">*</span></label>
                            <input type="text" name="currency_code" id="currency_code" class="form-control" 
                                   value="{{ old('currency_code', 'VND') }}" required>
                            @error('currency_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tổng số lượng và giá -->
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

                        <!-- Mã đơn hàng và số lần retry -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="order_id">{{ __('Mã đơn hàng liên kết (nếu có)') }}</label>
                                <input type="number" name="order_id" id="order_id" class="form-control" 
                                    value="{{ old('order_id') }}" min="0">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="retry_times">{{ __('Số lần retry') }}</label>
                                <input type="number" name="retry_times" id="retry_times" class="form-control" 
                                       value="{{ old('retry_times', 0) }}" min="0">
                            </div>
                        </div>

                        <!-- Danh sách sản phẩm -->
                        <h4 class="mt-4">{{ __('Danh sách sản phẩm') }}</h4>
                        <div id="cart-items-wrapper">
                            <div id="cart-item-template" class="cart-item row mb-3 d-none">
                                <div class="col-md-5">
                                    <label>{{ __('Sản phẩm') }}</label>
                                    <select name="items[__INDEX__][product_id]" class="form-control k_selectpicker" data-live-search="true" required>
                                        <option value="">{{ __('-- Chọn sản phẩm --') }}</option>
                                        @foreach ($inventories as $inventory)
                                            <option value="{{ $inventory['id'] }}" 
                                                    data-price="{{ $inventory['offer_price'] ?? $inventory['sale_price'] }}">
                                                {{ $inventory['title'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>{{ __('Số lượng') }}</label>
                                    <input type="number" name="items[__INDEX__][quantity]" class="form-control item-quantity" value="1" min="1">
                                </div>
                                <div class="col-md-2">
                                    <label>{{ __('Giá') }}</label>
                                    <input type="number" name="items[__INDEX__][price]" class="form-control item-price" step="0.01" min="0">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-item">{{ __('X') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" id="add-cart-item" class="btn btn-success btn-sm">
                                + {{ __('Thêm sản phẩm') }}
                            </button>
                        </div>

                        <!-- Trạng thái -->
                        <div class="form-group d-flex align-items-center mt-3">
                            <label class="mr-3">{{ __('Kích hoạt') }}</label>
                            <span class="k-switch">
                                <label>
                                    <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <span></span>
                                </label>
                            </span>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    $('.k_selectpicker').selectpicker();

    let index = 1;

    // Hàm khởi tạo selectpicker
    const initializeSelectPicker = (element) => {
        $(element).selectpicker();
    };

    // Hàm cập nhật tổng số lượng và tổng giá
    const updateTotals = () => {
        let totalQuantity = 0;
        let totalPrice = 0;
        document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)').forEach(item => {
            const quantity = parseInt(item.querySelector('.item-quantity').value) || 0;
            const price = parseFloat(item.querySelector('.item-price').value) || 0;
            totalQuantity += quantity;
            totalPrice += quantity * price;
        });
        document.getElementById('total_quantity').value = totalQuantity;
        document.getElementById('total_price').value = totalPrice.toFixed(2);
    };

    // Thêm sản phẩm
    document.getElementById('add-cart-item').addEventListener('click', () => {
        const wrapper = document.getElementById('cart-items-wrapper');
        const template = document.getElementById('cart-item-template');
        const clone = template.cloneNode(true);
        clone.classList.remove('d-none');

        // Thay __INDEX__ trong tên
        clone.querySelectorAll('input, select').forEach(el => {
            el.name = el.name.replace(/__INDEX__/, index);
            if (el.tagName === 'SELECT') {
                el.selectedIndex = 0;
            } else {
                el.value = el.name.includes('quantity') ? 1 : '';
            }
        });

        wrapper.appendChild(clone);
        initializeSelectPicker(clone.querySelector('.k_selectpicker'));

        // Tự động điền giá khi chọn sản phẩm
        clone.querySelector('.k_selectpicker').addEventListener('change', (e) => {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const priceInput = clone.querySelector('.item-price');
            priceInput.value = price ? parseFloat(price).toFixed(2) : '';
            updateTotals();
        });

        // Cập nhật tổng khi thay đổi số lượng
        clone.querySelector('.item-quantity').addEventListener('input', updateTotals);

        index++;
        updateTotals();
    });

    // Xóa sản phẩm
    document.getElementById('cart-items-wrapper').addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-item')) {
            const items = document.querySelectorAll('#cart-items-wrapper .cart-item:not(.d-none)');
            if (items.length > 1) {
                e.target.closest('.cart-item').remove();
                updateTotals();
            }
        }
    });

    // Tự động điền địa chỉ khi chọn người dùng
    document.getElementById('user_id').addEventListener('change', (e) => {
        const userId = e.target.value;
        const selectedOption = e.target.options[e.target.selectedIndex];
        const addressId = selectedOption.getAttribute('data-address-id') || '';

        // Điền địa chỉ vào input
        document.getElementById('address_id').value = addressId;

        // Nếu cần lấy thông tin địa chỉ chi tiết qua AJAX
        if (userId && addressId === '') {
            fetch(`/api/users/${userId}/address`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.address_id) {
                    document.getElementById('address_id').value = data.address_id;
                } else {
                    document.getElementById('address_id').value = '';
                }
            })
            .catch(error => {
                console.error('Lỗi khi lấy địa chỉ:', error);
                document.getElementById('address_id').value = '';
            });
        }
    });

    // Khởi tạo tổng số lượng và giá ban đầu
    updateTotals();
});
</script>
@endpush