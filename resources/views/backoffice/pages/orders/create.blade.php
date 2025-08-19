@extends('backoffice.layouts.master')

@php
    $title = __('Tạo đơn hàng');
    $breadcrumbs = [
        ['label' => __('Quản lý mua hàng')],
        ['label' => __('Đơn hàng')],
        ['label' => __('Tạo đơn hàng')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent



@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <form class="k-form k-form--label-right" id="form_create_order" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">1. {{ __('Thông tin khách hàng') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('Khách hàng') }} *</label>
                                    <select data-actions-box="true" name="user_id" title="-- {{ __('Chọn khách hàng') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5">
                                        @foreach($users as $user)
                                        <option
                                            data-tokens="{{ (string) $user->name }} | {{ (string) $user->email }} | {{ (string) $user->phone_number ?? 'N/A' }}"
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>{{ __('Kênh mua hàng') }} *</label>
                                    <select name="order_channel[type]" data-live-search="true" class="form-control k_selectpicker  {{ $errors->has('order_channel.type') ? 'is-invalid' : '' }}" required>
                                        @foreach($accessChannelTypeLables as $key => $label)
                                        <option value="{{ $key }}" {{ old('order_channel.type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('order_channel.type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="form-group col-md-12">
                                    <label for="">{{ __('Reference kênh truy cập') }}</label>
                                    <input type="text" class="form-control" name="order_channel[reference_id]" placeholder="{{ __('Nhập reference kênh truy cập') }}" value="{{ old('order_channel.reference_id') }}">
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">2. {{ __('Tạo giỏ hàng') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <select name="inventory_id" title="-- {{ __('Chọn sản phẩm thêm vào giỏ hàng') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5">
                                        @foreach($inventories as $inventory)
                                        <option
                                            value="{{ $inventory->id }}"
                                            data-tokens="{{ $inventory->id }} | {{ $inventory->title }} | {{ $inventory->sku }}"
                                            data-slug="{{ $inventory->slug }}"
                                            data-inventory-id="{{ $inventory->id }}"
                                            data-inventory-name="{{ $inventory->title }}"
                                            data-value='@json($inventory)'
                                        >{{ $inventory->title }} (SKU: {{ $inventory->sku }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" id="btn_add_to_cart">{{ __('Tạo vào giỏ hàng') }}</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">{{ __('Sản phẩm trong giỏ') }}</div>
                                    <table id="items_in_cart_table" class="datatable table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <th>{{ __('STT') }}</th>
                                            <th>{{ __('Ảnh') }}</th>
                                            <th>{{ __('Tên') }}</th>
                                            <th>{{ __('Giá') }}</th>
                                            <th>{{ __('Số lượng') }}</th>
                                            <th>{{ __('Tổng giá') }}</th>
                                            <th>{{ __('Xoá') }}</th>
                                        </thead>
                                        <tbody>
                                            {{-- Code... --}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><b>Tổng cộng</b></td>
                                                <td>
                                                    <input data-name="total_quantity" type="text" disabled class="form-control">
                                                    <input type="hidden" name="total_quantity" id="input_total_quantity" />
                                                </td>
                                                <td>
                                                    <input data-name="total_price" type="text" disabled class="form-control">
                                                    <input type="hidden" name="total_price" id="input_total_price" />
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">3. {{ __('Địa chỉ giao hàng') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Tên khách hàng') }} *</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="{{ __('Nhập tên khách hàng') }}" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('E-mail khách hàng') }}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ __('Nhập e-mail khách hàng') }}" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('SĐT khách hàng') }} *</label>
                                    <input type="text" class="form-control" name="phone" placeholder="{{ __('Nhập SĐT khách hàng') }}" value="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Tên công ty') }}</label>
                                    <input type="text" class="form-control" name="company" placeholder="{{ __('Nhập tên công ty') }}" value="">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>{{ __('Tên đường cụ thể') }}</label>
                                    <input type="text" class="form-control" name="address_line" id="address_line" placeholder="{{ __('Nhập tên đường') }}" value="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Tỉnh/Thành Phố') }} *</label>
                                    <select data-actions-box="true" name="province_code" title="-- {{ __('Chọn Tỉnh/TP') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5">
                                        @foreach($provinces as $province)
                                        <option
                                            {{ in_array($province->code, old("supported_provinces", [])) ? 'selected' : '' }}
                                            data-tokens="{{ $province->code }} | {{ $province->full_name }}"
                                            data-province-code="{{ $province->code }}"
                                            data-province-name="{{ $province->full_name }}"
                                            value="{{ $province->code }}">{{ $province->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('Quận/Huyện') }} *</label>
                                    <select data-actions-box="true" name="district_code" title="-- {{ __('Chọn Quận/Huyện') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5" disabled data-districts='@json($districts)'>
                                        {{-- Render --}}
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('Phường/Xã') }} *</label>
                                    <select data-actions-box="true" name="ward_code" title="-- {{ __('Chọn Phường/Xã') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5" disabled data-wards='@json($wards)'>
                                        {{-- Render --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">4. {{ __('Thông tin vận chuyển') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Tùy chọn vận chuyển') }} *</label>
                                    <select name="shipping_option_id" title="-- {{ __('Chọn tuỳ chọn vận chuyển') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5" >

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">5. {{ __('Thông tin ghi chú') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_note">{{ __('Ghi chú người dùng') }} *</label>
                                    <textarea name="user_note" id="user_note" class="form-control" rows="5" placeholder="{{ __('Nhập ghi chú của người dùng') }}"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="admin_note">{{ __('Ghi chú quản trị') }} *</label>
                                    <textarea name="admin_note" id="admin_note" class="form-control" rows="5" placeholder="{{ __('Nhập ghi chú của quản trị') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">6. {{ __('Thông tin thanh toán') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Tùy chọn thanh toán') }} *</label>
                                    <select title="-- {{ __('Chọn tùy chọn thanh toán') }} --" name="payment_option_id" data-size="5" data-live-search="true" class="form-control k_selectpicker" data-selected-text-format="count > 5">
                                        @foreach($paymentOptions as $option)
                                        <option value="{{ $option->id }}" data-tokens="{{ $option->id }} | {{ $option->name }}">{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                                <button type="redirect" class="btn btn-secondary">{{ __('Huỷ') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet">
                        <div class="k-portlet__head">
                            <div class="k-portlet__head-label">
                                <h3 class="k-portlet__head-title">7. {{ __('Mã giảm giá') }}</h3>
                            </div>
                        </div>

                        <div class="k-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="coupon_code">{{ __('Nhập mã giảm giá') }}</label>
                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="{{ __('VD: SALE10') }}">
                                    <small class="form-text text-muted">{{ __('Nếu có mã giảm giá, nhập vào đây') }}</small>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-end">
                                    <button type="button" class="btn btn-success" id="btn_apply_coupon">{{ __('Áp dụng') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js_script')
@include('backoffice.pages.orders.js-pages.create')
@endsection




