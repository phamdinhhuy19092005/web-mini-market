@extends('backoffice.layouts.master')

@php
    $title = 'Tạo phương thức vận chuyển';
    $breadcrumbs = [
        ['label' => 'Vận chuyển'],
        ['label' => 'Quản lý phương thức vận chuyển'],
        ['label' => 'Tạo phương thức vận chuyển'],
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
                        <h3 class="k-portlet__head-title">Tạo phương thức vận chuyển</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.shipping-options.store') }}" method="POST" class="k-form">
                    @csrf
                    <div class="k-portlet__body">
                        <!-- Tên -->
                        <div class="form-group">
                            <label for="name">Tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="Nhập tên phương thức">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Loại hình -->
                        <div class="form-group">
                            <label for="type">Loại hình</label>
                            <select name="type" id="type" class="form-control k_selectpicker">
                                @foreach($ShippingOptionTypeEnumLables as $value => $label)
                                    <option value="{{ $value }}" 
                                            {{ old('type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="form-group">
                            <label for="logo">Logo (URL hoặc đường dẫn file)</label>
                            <input type="text" name="logo" id="logo" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   value="{{ old('logo') }}" 
                                   placeholder="https://example.com/logo.png">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nhà cung cấp vận chuyển -->
                        <div class="form-group">
                            <label for="shipping_provider_id">Nhà cung cấp vận chuyển</label>
                            <select name="shipping_provider_id" id="shipping_provider_id" 
                                    class="form-control k_selectpicker">
                                @foreach($shippingProviders ?? [] as $provider)
                                    <option value="{{ $provider->id }}" 
                                            {{ old('shipping_provider_id') == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipping_provider_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mô tả thêm -->
                        <div class="form-group">
                            <label for="expanded_content">Mô tả thêm</label>
                            <textarea name="expanded_content" id="expanded_content" rows="4" 
                                      class="form-control">{{ old('expanded_content') }}</textarea>
                        </div>

                        <!-- Trạng thái -->
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">Trạng thái</label>
                            <span class="k-switch">
                                <label>
                                    <input type="checkbox" name="status" value="1" checked>
                                    <span></span>
                                </label>
                            </span>
                        </div>

                        <!-- Thứ tự hiển thị -->
                        <div class="form-group">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" name="order" id="order" 
                                   class="form-control" 
                                   value="{{ old('order', 0) }}">
                        </div>

                        <!-- Thông số (JSON) -->
                        <div class="form-group">
                            <label>{{ __('Tham số') }}</label>
                            <div id="json_editor_params" style="height: 200px; border: 1px solid #ebedf2;"></div>
                            <input type="hidden" name="params" value="{{ old('params', '{}') }}">
                        </div>

                        <!-- Quốc gia áp dụng (JSON) -->
                        <div class="form-group">
                            <label>{{ __('Quốc gia áp dụng') }}</label>
                            <select name="supported_countries[]" class="form-control k_selectpicker Supported_Countries_Selector" title="-- {{ __('Chọn quốc gia') }} --" data-actions-box="true"
                                data-size="5"
                                data-live-search="true"
                                data-selected-text-format="count > 5"
                                multiple
                            >
                                @foreach($countries as $country)
                                    <option value="{{ $country->iso2 }}" data-tokens="{{ $country->iso2 }} | {{ $country->name }}" data-subtext="{{ $country->iso2 }}" data-country-iso2="{{ $country->iso2 }}" data-country-name="{{ $country->name }}" {{ in_array($country->iso2, old('supported_countries', [])) ? 'selected' : '' }}
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supported_countries')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="Badge_Holder_Wrapper form-group Supported_Countries_Allowed_Holder mb-0">
                                <div class="Supported_Countries_Holder_Content"></div>
                            </div>
                        </div>

                        <!-- Tỉnh/thành áp dụng (JSON) -->
                        <div class="form-group">
                            <label>{{ __('Tỉnh/TP hỗ trợ') }}</label>
                            <select
                                name="supported_provinces[]"
                                title="-- {{ __('Chọn Tỉnh/TP') }} --"
                                data-size="5"
                                data-live-search="true"
                                class="form-control k_selectpicker Supported_Provinces_Selector"
                                multiple
                                data-actions-box="true"
                                data-selected-text-format="count > 5"
                            >
                                @foreach($provinces as $province)
                                    <option
                                        value="{{ $province->code }}"
                                        data-tokens="{{ $province->code }} | {{ $province->full_name }}"
                                        data-province-code="{{ $province->code }}"
                                        data-province-name="{{ $province->full_name }}"
                                        {{ in_array($province->code, old('supported_provinces', [])) ? 'selected' : '' }}
                                    >
                                        {{ $province->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supported_provinces')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="Badge_Holder_Wrapper form-group Supported_Provinces_Allowed_Holder mb-0">
                                <div class="Supported_Provinces_Holder_Content"></div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('bo.web.shipping-options.index') }}" 
                               class="btn btn-secondary">Huỷ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js"></script>
<script>
    $(function () {
        let editor = ace.edit('json_editor_params', {
            mode: 'ace/mode/json',
            theme: 'ace/theme/tomorrow'
        });

        editor.setValue($('input[name="params"]').val() || '{}', -1);

        $('#form_payment-providers').on('submit', function () {
            $('input[name="params"]').val(editor.getValue());
        });
    });
</script>
@endpush