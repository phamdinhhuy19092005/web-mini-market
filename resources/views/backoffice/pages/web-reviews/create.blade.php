@extends('backoffice.layouts.master')

@php
    $title = __('Tạo đánh giá');
    $breadcrumbs = [
        ['label' => __('Hỗ trợ khách hàng')],
        ['label' => __('Tạo đánh giá')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- Begin: Content Body -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: Portlet -->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Thông tin đánh giá') }}</h3>
                        </div>
                    </div>

                    <!-- Begin: Form -->
                    <form action="{{ route('bo.web.website-reviews.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="k-portlet__body">
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

                                <!-- Rating Field -->
                                <div class="col-md-4 form-group">
                                    <label>{{ __('Đánh giá') }} <span class="text-danger">*</span></label>
                                    <div class="rating-stars d-flex flex-row-reverse justify-content-end">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                   {{ old('rating') == $i ? 'checked' : '' }} required/>
                                            <label for="star{{ $i }}" title="{{ $i }} sao">★</label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Comment Field -->
                                <div class="col-md-12 form-group">
                                    <label for="comment">{{ __('Nhận xét') }}</label>
                                    <textarea name="comment" rows="4" class="form-control" placeholder="{{ __('Viết nhận xét...') }}">{{ old('comment') }}</textarea>
                                </div>

                                <!-- Status Toggle -->
                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">{{ __('Kích hoạt (tán thành)') }}</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">{{ __('Gửi đánh giá') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('Hủy') }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- End: Form -->
                </div>
                <!-- End: Portlet -->
            </div>
        </div>
    </div>
    <!-- End: Content Body -->

    <!-- Inline CSS for Rating Stars -->
    <style>
        .rating-stars input[type="radio"] {
            display: none;
        }

        .rating-stars label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-stars input[type="radio"]:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ffc107;
        }
    </style>
@endsection