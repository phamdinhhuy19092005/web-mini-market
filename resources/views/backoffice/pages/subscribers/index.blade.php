@extends('backoffice.layouts.master')

@php
    $title = __('Người đăng ký');
    $breadcrumbs = [
        ['label' => __('Hỗ trợ khách hàng')],
        ['label' => __('Người đăng ký')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">
                <div class="k-portlet k-portlet--mobile">
                    <div class="k-portlet__head k-portlet__head--lg">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">{{ __('Danh sách người đăng ký') }}</h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#sendMailModal">
                                <i class="fa fa-paper-plane"></i> {{ __('Gửi email đến người đăng ký') }}
                            </button>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit p-4">
                        <table id="table_subscribers_index"
                               data-searching="true"
                               data-request-url="{{ route('bo.api.subscribers.index') }}"
                               class="datatable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <th data-property="id">{{ __('ID') }}</th>
                                    <th data-orderable="false" data-property="email">{{ __('E-mail') }}</th>
                                    <th data-orderable="false" data-property="type_name">{{ __('Loại') }}</th>
                                    <th data-orderable="false" data-property="created_at">{{ __('Đã đăng ký lúc') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Gửi Email -->
        <div class="modal fade" id="sendMailModal" tabindex="-1" role="dialog" aria-labelledby="sendMailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('bo.web.subscribers.sendmail') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sendMailModalLabel">{{ __('Gửi email đến tất cả người đăng ký') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="subject">{{ __('Tiêu đề') }}</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="content">{{ __('Nội dung email') }}</label>
                                <textarea class="form-control" name="content" id="content" rows="6" required placeholder="{{ __('Nhập nội dung...') }}"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">{{ __('Gửi') }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Hủy') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @component('backoffice.partials.datatable')
    @endcomponent
@endsection
