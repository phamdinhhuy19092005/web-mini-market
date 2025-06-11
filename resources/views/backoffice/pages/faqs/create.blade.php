@extends('backoffice.layouts.master')

@php
    $title = __('Create Faq Topics');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Faq Topics'),
        ],
        [
            'label' => __('Create Faq Topics'),
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
                            <h3 class="k-portlet__head-title">Create Faq Topics</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.faqs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                            <div class="form-group">
                                <label for="question">Câu hỏi</label>
                                <input type="text" name="question" id="question" class="form-control"
                                    placeholder="Nhập câu hỏi" autocomplete="off" value="{{ old('question') }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Câu trả lời</label>
                                <textarea name="answer" id="answer" class="form-control" rows="5">{{ old('answer') }}</textarea>
                            </div>

                            <div class="form-group" style="width: 100%">
                                <label for="faq_topic_id" class="form-label fw-bold d-block mb-2">
                                    Chủ đề <span class="text-danger">*</span>
                                </label>
                                <select name="faq_topic_id" id="faq_topic_id" class="form-select selectpicker" data-live-search="true" required>
                                    <option value="">-- Chọn chủ đề --</option>
                                    @foreach($faqTopics as $faqTopic)
                                        <option value="{{ $faqTopic->id }}"
                                            {{ old('faq_topic_id') == $faqTopic->id ? 'selected' : '' }}>
                                            {{ $faqTopic->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự hiển thị</label>
                                <input type="number" min="1" name="order" id="order" class="form-control" value="{{ old('order') }}">
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1" checked>
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
    <!-- end:: Content Body -->

    @include('backoffice.pages.faqs.js.faq');
    
@endsection