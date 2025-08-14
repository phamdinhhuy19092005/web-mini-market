@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa đánh giá');

    $breadcrumbs = [
        [
            'label' => __('Hỗ trợ khách hàng'),
        ],
        [
            'label' => __('Đánh giá websites'),
        ],
        [
            'label' => __('Chỉnh sửa đánh giá'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

<!-- begin:: Content Body -->
@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">
                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Chỉnh sửa đánh giá</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.website-reviews.update', $web_review->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="k-portlet__body">
                            <div class="row">
                                <!-- Name Field -->
                                <div class="col-md-4 form-group">
                                    <label for="name">{{ __('Tên của bạn') }} <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('name', $web_review->name) }}" class="form-control" disabled>
                                    <input type="hidden" name="name" value="{{ old('name', $web_review->name) }}">
                                </div>

                                <!-- Email Field -->
                                <div class="col-md-4 form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email" value="{{ old('email', $web_review->email) }}" class="form-control" disabled>
                                    <input type="hidden" name="email" value="{{ old('email', $web_review->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone Number Field -->
                                <div class="col-md-4 form-group">
                                    <label for="phone">{{ __('Số điện thoại') }} <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('phone_number', $web_review->phone_number) }}" class="form-control" disabled>
                                    <input type="hidden" name="phone_number" value="{{ old('phone_number', $web_review->phone_number) }}">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Rating Field -->
                                <div class="col-md-4 form-group">
                                    <label>{{ __('Đánh giá') }} <span class="text-danger">*</span></label>
                                    <div class="rating-stars d-flex flex-row-reverse justify-content-end">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                   {{ old('rating', $web_review->rating) == $i ? 'checked' : '' }} readonly required/>
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
                                    <textarea name="comment" rows="4" class="form-control" placeholder="{{ __('Viết nhận xét...') }}" disabled>{{ old('comment', $web_review->comment) }}</textarea>
                                </div>

                                <!-- Status Dropdown -->
                                <div class="col-md-6 form-group">
                                    <label for="status">{{ __('Trạng thái') }}</label>
                                    <select name="status" class="form-control k_selectpicker">
                                        <option value="{{ \App\Enum\ReviewStatusEnum::DECLINED->value }}" 
                                            {{ (string) old('status', $web_review->status ?? \App\Enum\ReviewStatusEnum::APPROVED->value) === (string) \App\Enum\ReviewStatusEnum::DECLINED->value ? 'selected' : '' }}>
                                            {{ __('Từ chối') }}
                                        </option>

                                        <option value="{{ \App\Enum\ReviewStatusEnum::PENDING->value }}" 
                                            {{ (string) old('status', $web_review->status ?? \App\Enum\ReviewStatusEnum::APPROVED->value) === (string) \App\Enum\ReviewStatusEnum::PENDING->value ? 'selected' : '' }}>
                                            {{ __('Đang chờ') }}
                                        </option>

                                        <option value="{{ \App\Enum\ReviewStatusEnum::APPROVED->value }}" 
                                            {{ (string) old('status', $web_review->status ?? \App\Enum\ReviewStatusEnum::APPROVED->value) === (string) \App\Enum\ReviewStatusEnum::APPROVED->value ? 'selected' : '' }}>
                                            {{ __('Đã duyệt') }}
                                        </option>
                                    </select>

                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
    <!-- end:: Content Body -->

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