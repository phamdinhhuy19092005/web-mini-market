@extends('backoffice.layouts.master')

@php
    $title = 'Chỉnh sửa Cước phí vận chuyển';

    $breadcrumbs = [
        [
            'label' => 'Vận chuyển',
        ],
        [
            'label' => 'Cài đặt vận chuyển',
        ],
        [
            'label' => 'Cước phí vận chuyển',
        ],
        [
            'label' => 'Chỉnh sửa Cước phí vận chuyển',
        ],
    ];
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
                            <h3 class="k-portlet__head-title">Chỉnh sửa Vùng Vận chuyển</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.shipping-rates.update', $rate->id) }}" method="POST" enctype="multipart/form-data">
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
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-form-label">
                                    Tên <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Nhập tên" 
                                           autocomplete="off" 
                                           value="{{ old('name', $rate->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Shipping Zone Field -->
                            <div class="form-group">
                                <label for="shipping_zone_id" class="col-sm-2 col-form-label">
                                    Vùng Vận chuyển <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="shipping_zone_id" id="shipping_zone_id" 
                                            class="form-select selectpicker" 
                                            data-live-search="true" 
                                            data-width="400px" 
                                            required>
                                        <option value="">Chọn vùng vận chuyển</option>
                                        @foreach($shippingZones as $shippingZone)
                                            <option value="{{ $shippingZone->id }}"
                                                {{ old('shipping_zone_id', $rate->shipping_zone_id) == $shippingZone->id ? 'selected' : '' }}>
                                                {{ $shippingZone->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('shipping_zone_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Delivery Takes Field -->
                            <div class="form-group">
                                <label for="delivery_takes" class="col-sm-2 col-form-label">
                                    Thời gian Giao hàng <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" 
                                           class="form-control @error('delivery_takes') is-invalid @enderror" 
                                           name="delivery_takes" 
                                           id="delivery_takes" 
                                           placeholder="2-5 ngày" 
                                           value="{{ old('delivery_takes', $rate->delivery_takes) }}" 
                                           required>
                                    @error('delivery_takes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type Field -->
                            <div class="form-group">
                                <label for="type" class="col-sm-2 col-form-label">
                                    Loại <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="type" id="type" 
                                            class="form-control k_selectpicker" 
                                            required>
                                        <option value="">Chọn loại</option>
                                        @foreach($shippingRateTypeEnumLabels as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('type', $rate->type) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Minimum and Maximum Fields -->
                            <div class="row" data-tab-select-by-type="1">
                                <!-- Minimum -->
                                <div class="col-md-6 form-group">
                                    <label for="minimum" class="col-sm-4 col-form-label">
                                        Giá Tối thiểu <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" 
                                                id="minimum" 
                                                data-digits="2" 
                                                data-type="inputmask_numeric" 
                                                data-allow-minus="false" 
                                                class="form-control @error('minimum') is-invalid @enderror" 
                                                data-key="minimum" 
                                                value="{{ old('minimum', $rate->minimum) }}"
                                                required>
                                                   
                                            <input type="hidden" 
                                                data-type="inputmask_numeric_unmasked" 
                                                name="minimum" 
                                                data-key="minimum" 
                                                required 
                                                value="{{ old('minimum', $rate->minimum) }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">₫</span>
                                            </div>
                                        </div>
                                        @error('minimum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Maximum -->
                                <div class="col-md-6 form-group">
                                    <label for="maximum" class="col-sm-4 col-form-label">
                                        Giá Tối đa
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" 
                                                   id="maximum" 
                                                   data-digits="2" 
                                                   data-type="inputmask_numeric" 
                                                   data-allow-minus="false" 
                                                   class="form-control @error('maximum') is-invalid @enderror" 
                                                   value="{{ old('maximum', $rate->maximum) }}"
                                                   data-key="maximum">
                                            <input type="hidden" 
                                                   data-type="inputmask_numeric_unmasked" 
                                                   name="maximum" 
                                                   data-key="maximum" 
                                                   value="{{ old('maximum', $rate->maximum) }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">₫</span>
                                            </div>
                                        </div>
                                        @error('maximum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Rate Field -->
                            <div class="form-group">
                                <label for="rate" class="col-sm-2 col-form-label">
                                    Phí Vận chuyển <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" 
                                               id="rate" 
                                               data-digits="2" 
                                               data-type="inputmask_numeric" 
                                               data-allow-minus="false" 
                                               class="form-control @error('rate') is-invalid @enderror" 
                                               data-key="rate" 
                                               value="{{ old('rate', $rate->rate) }}"
                                               required>
                                        <input type="hidden"
                                               name="rate"
                                               value="{{ old('rate', $rate->rate) }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">₫</span>
                                        </div>
                                    </div>
                                    <div id="is_free_shipping" class="mt-2 text-success">
                                        Miễn phí Vận chuyển
                                    </div>
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hiển thị trên Frontend</label>
                                <span class="k-switch d-flex" style="margin-left: 70px;">
                                    <label>
                                        <input type="checkbox" name="display_on_frontend" value="1" {{ old('display_on_frontend', $rate->display_on_frontend) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status', $rate->status) ? 'checked' : '' }}>
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

    @include('backoffice.pages.shipping-rates.pagejs.app')
@endsection