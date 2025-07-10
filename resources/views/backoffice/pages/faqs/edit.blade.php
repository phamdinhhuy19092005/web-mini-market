@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa Câu Hỏi Thường Gặp');

    $breadcrumbs = [
        ['label' => __('Tiện Ích')],
        ['label' => __('Câu Hỏi Thường Gặp')],
        ['label' => __('Chỉnh sửa Câu Hỏi')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- Begin::Content Body -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-12">
                <!-- Begin::Portlet -->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Chỉnh sửa Câu Hỏi Thường Gặp</h3>
                        </div>
                    </div>

                    <!-- Begin::Form -->
                    <form action="{{ route('bo.web.faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="k-portlet__body">
                            <div class="row">
                                <!-- Question -->
                                <div class="col-md-6 form-group">
                                    <label for="question">Câu hỏi <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="question"
                                        id="question"
                                        class="form-control"
                                        placeholder="Nhập câu hỏi"
                                        autocomplete="off"
                                        value="{{ old('question', $faq->question) }}"
                                        required>
                                </div>

                                <!-- Order -->
                                <div class="col-md-6 form-group">
                                    <label for="order">Thứ tự hiển thị</label>
                                    <input
                                        type="number"
                                        min="1"
                                        name="order"
                                        id="order"
                                        class="form-control"
                                        value="{{ old('order', $faq->order) }}">
                                </div>

                                <!-- Topic -->
                                <div class="col-md-6 form-group">
                                    <label for="faq_topic_id">Chủ đề <span class="text-danger">*</span></label>
                                    <select
                                        name="faq_topic_id"
                                        id="faq_topic_id"
                                        class="form-select selectpicker"
                                        data-live-search="true"
                                        required>
                                        <option value="">-- Chọn chủ đề --</option>
                                        @foreach($faqTopics as $faqTopic)
                                            <option value="{{ $faqTopic->id }}"
                                                {{ old('faq_topic_id', $faq->faq_topic_id) == $faqTopic->id ? 'selected' : '' }}>
                                                {{ $faqTopic->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">Kích hoạt</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="checkbox" name="status" value="1"
                                                {{ old('status', $faq->status) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>

                                <!-- Answer -->
                                <div class="col-md-12 form-group">
                                    <label for="answer">Câu trả lời <span class="text-danger">*</span></label>
                                    <x-backoffice.content-editor
                                        id="post_content"
                                        name="answer"
                                        :value="old('answer', $faq->answer)"
                                        :cols="30"
                                        :rows="10"
                                        placeholder="Nhập câu trả lời..."
                                        disk="public"
                                        class=""
                                        :config="[]"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">Cập nhật câu hỏi</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </div>
                    </form>
                    <!-- End::Form -->
                </div>
                <!-- End::Portlet -->
            </div>
        </div>
    </div>
    <!-- End::Content Body -->

    @include('backoffice.pages.faqs.js.faq')
@endsection
