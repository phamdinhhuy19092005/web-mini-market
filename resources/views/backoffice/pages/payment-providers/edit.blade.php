@extends('backoffice.layouts.master')

@php
    $title = __('Tạo đơn vị thanh toán');
    $breadcrumbs = [
        ['label' => __('Cài đặt thanh toán')],
        ['label' => __('Đơn vị thanh toán')],
        ['label' => __('Tạo đơn vị thanh toán')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" style="max-width: 600px">
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">{{ __('Thông tin đơn vị thanh toán') }}</h3>
            </div>
        </div>

        <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.payment-providers.update', $payment_provider->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="k-portlet__body">
                <div class="row">
                    <div class="col-md">
                        {{-- Tên --}}
                        <div class="form-group">
                            <label for="name">{{ __('Tên') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nhập tên đơn vị') }}"  value="{{ old('name', $payment_provider->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Nhà cung cấp --}}
                        <div class="form-group">
                            <label for="code">{{ __('Nhà cung cấp') }} <span class="text-danger">*</span></label>
                            <select class="form-control k_selectpicker" name="code" id="code" required>
                                <option value="">-- {{ __('Chọn nhà cung cấp') }} --</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider['code'] }}" 
                                        {{ old('code', $payment_provider->code) == $provider['code'] ? 'selected' : '' }}>
                                        {{ $provider['name'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Loại thanh toán --}}
                        <div class="form-group">
                            <label for="payment_type">{{ __('Loại thanh toán') }}</label>
                            <select class="form-control k_selectpicker" name="payment_type" id="payment_type">
                                @foreach ($paymentTypeEnumLabels as $key => $label)
                                    <option value="{{ $key }}" 
                                        {{ old('payment_type', $payment_provider->payment_type) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tham số --}}
                        <div class="form-group">
                            <label>{{ __('Tham số') }}</label>
                            <div id="json_editor_params" style="height: 200px; border: 1px solid #ebedf2;"></div>
                            <input type="hidden" name="params" value="{{ old('params', json_encode($payment_provider->params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}">

                        </div>

                        {{-- Hoạt động --}}
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">{{ __('Hoạt động') }}</label>

                            {{-- Hidden input để khi checkbox không check vẫn submit value 0 --}}
                            <input type="hidden" name="status" value="0">

                            <div class="k-switch">
                                <label>
                                    <input type="checkbox" name="status" value="1" {{ old('status', $payment_provider->status) ? 'checked' : '' }}>
                                    <span></span>
                                </label>
                            </div>

                            @error('status')
                                <small class="text-danger ml-2">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="k-portlet__foot">
                <div class="k-form__actions">
                    <button type="submit" class="btn btn-primary mr-2">{{ __('Lưu') }}</button>
                    <a href="{{ route('bo.web.payment-providers.index') }}" class="btn btn-outline-secondary">{{ __('Hủy') }}</a>
                </div>
            </div>
        </form>
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




