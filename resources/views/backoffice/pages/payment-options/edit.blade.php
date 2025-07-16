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

        <form class="k-form k-form--label-right" method="POST" action="{{ route('bo.web.payment-options.update', $payment_option->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="k-portlet__body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label>{{ __('Tiền tệ') }} *</label>
                            <select name="currency_code" id="currency_code" class="form-control k_selectpicker" data-live-search="true" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->currency }}"
                                        title="{{ $country->currency }} - {{ $country->currency_name }}"
                                        {{ old('currency_code', $payment_option->currency_code) == $country->currency ? 'selected' : '' }}>
                                        {{ $country->currency }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                           <label for="payment_type">{{ __('Loại thanh toán') }}</label>
                            <select name="payment_type" id="payment_type" class="form-control k_selectpicker">
                                <option value="">-- {{ __('Chọn loại thanh toán') }} --</option>
                                @foreach ($paymentOptionTypeEnumLabels as $key => $label)
                                    <option value="{{ $key }}" {{ old('payment_type', $payment_option->type) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_provider_id">{{ __('Nhà cung cấp thanh toán') }}</label>
                            <select name="payment_provider_id" id="payment_provider_id" class="form-control k_selectpicker" data-live-search="true">
                                <option value="">-- {{ __('Chọn nhà cung cấp') }} --</option>
                                @foreach ($paymentProviders as $provider)
                                    <option value="{{ $provider->id }}" {{ old('payment_provider_id', $payment_option->payment_provider_id) == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_provider_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Tên --}}
                        <div class="form-group">
                            <label for="name">{{ __('Tên tùy chọn thanh toán') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $payment_option->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Logo') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control image-url" name="logo[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}" value="{{ old('logo.path',$payment_option->logo ) }}">
                                <div class="input-group-append">
                                    <label class="btn btn-outline-primary m-0" for="image-file">
                                        <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                        <input type="file" id="image-file" name="logo[file]" class="d-none image-file" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <img class="img-fluid image-preview" style="max-width: 150px; display: {{ $payment_option->logo ? 'block' : 'none' }};" src="{{ $payment_option->logo ?? '' }}" alt="Image preview">
                            </div>
                            @error('image.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Thứ tự') }}</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', $payment_option->order) }}">
                            @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Số tiền tối thiểu') }}</label>
                            <x-number-input
                                name="min_amount"
                                key="min_amount"
                                class="form-control number-format {{ $errors->has('min_amount') ? 'is-invalid' : '' }}"
                                value="{{ old('min_amount', $payment_option->min_amount) }}"
                                :allow-minus="false"
                            />

                        </div>

                        <div class="form-group">
                            <label>{{ __('Số tiền tối đa') }}</label>
                            <x-number-input
                                allow-minus="false"
                                key="max_amount"
                                name="max_amount"
                                class="form-control number-format {{ $errors->has('max_amount') ? 'is-invalid' : '' }}"
                                value='{{ old("max_amount", $payment_option->max_amount) }}'
                            />
                        </div>

                        <div class="form-group">
                            <label>{{ __('Nội dung mở rộng') }}</label>
                            <textarea name="expanded_content" class="form-control">{{ old('expanded_content', $payment_option->expanded_content) }}</textarea>
                        </div>

                        {{-- Tham số --}}
                        <div class="form-group">
                            <label>{{ __('Tham số') }}</label>
                            <div id="json_editor_params" style="height: 200px; border: 1px solid #ebedf2;"></div>
                            <input type="hidden" name="params" value="{{ old('params', json_encode($payment_option->params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}">
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">{{ __('Hiển thị FE') }}</label>
                            <div class="k-switch">
                                <label>
                                    <input type="checkbox" name="display_on_frontend" value="1" {{ old('display_on_frontend', $payment_option->display_on_frontend) ? 'checked' : '' }}>
                                    <span></span>
                                </label>
                            </div>
                            @error('status')
                                <small class="text-danger ml-2">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Hoạt động --}}
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">{{ __('Hoạt động') }}</label>
                            <div class="k-switch">
                                <label>
                                    <input type="checkbox" name="status" value="1" {{ old('status', $payment_option->status) ? 'checked' : '' }}>
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
<script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

<script>
    $(function () {
        let editor = ace.edit('json_editor_params', {
            mode: 'ace/mode/json',
            theme: 'ace/theme/tomorrow'
        });

        editor.setValue($('input[name="params"]').val() || '{}', -1);

        $('#form_payment-options').on('submit', function () {
            $('input[name="params"]').val(editor.getValue());

            // Gỡ format số trước khi submit
            $('.number-format').each(function () {
                let val = $(this).val().replace(/[^0-9.]/g, '');
                $(this).val(val);
            });
        });

        $('.number-format').each(function () {
            new Cleave(this, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    });

</script>
@endpush




