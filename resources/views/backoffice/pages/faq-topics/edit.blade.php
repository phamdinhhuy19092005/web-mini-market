@extends('backoffice.layouts.master')

@php
    $title = __('Edit Faq Topics');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Faq Topics'),
        ],
        [
            'label' => __('Edit Faq Topics'),
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
                            <h3 class="k-portlet__head-title">Edit Faq Topics</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.faq-topics.update', $faqTopic->id) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên" autocomplete="off"
                                    value="{{ old('name', $faqTopic->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự hiển thị</label>
                                <input type="number" name="order" id="order" class="form-control" min="1" placeholder="Nhập thứ tự"
                                    value="{{ old('order', $faqTopic->order) }}">
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>Hoạt động</label>
                                <span class="k-switch d-flex" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                            {{ old('status', $faqTopic->status) ? 'checked' : '' }}>
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
@endsection