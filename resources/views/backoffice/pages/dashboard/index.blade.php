@extends('backoffice.layouts.master')

@php
$title = __('Bảng Điều Khiển');

$breadcrumbs = [
    [
        // 'label' => $title,
    ],
];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

<!-- begin:: Nội Dung Chính -->
@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">

    <!--begin::Hàng-->
    <div class="row">
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Doanh Số Tác Giả</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="k-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="k-nav">
                                        <li class="k-nav__section k-nav__section--first">
                                            <span class="k-nav__section-text">Công Cụ Xuất</span>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-print"></i>
                                                <span class="k-nav__link-text">In</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-copy"></i>
                                                <span class="k-nav__link-text">Sao Chép</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-excel-o"></i>
                                                <span class="k-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-text-o"></i>
                                                <span class="k-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="k-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-19">
                        <div class="k-widget-19__title">
                            <div class="k-widget-19__label"><small>$</small>64M</div>
                            <img class="k-widget-19__bg" src="../assets/media/misc/iconbox_bg.png" alt="bg" />
                        </div>
                        <div class="k-widget-19__data">
                            <div class="k-widget-19__chart">
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-45" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="45"></div>
                                </div>
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-95" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="95"></div>
                                </div>
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-63" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="63"></div>
                                </div>
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-11" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="11"></div>
                                </div>
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-46" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="46"></div>
                                </div>
                                <div class="k-widget-19__bar">
                                    <div class="k-widget-19__bar-88" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="88"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->

        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Công Nghệ</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="k-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="k-nav">
                                        <li class="k-nav__section k-nav__section--first">
                                            <span class="k-nav__section-text">Công Cụ Xuất</span>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-print"></i>
                                                <span class="k-nav__link-text">In</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-copy"></i>
                                                <span class="k-nav__link-text">Sao Chép</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-excel-o"></i>
                                                <span class="k-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-text-o"></i>
                                                <span class="k-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="k-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-21">
                        <div class="k-widget-21__title">
                            <div class="k-widget-21__label">9.3M</div>
                            <img src="../assets/media/misc/iconbox_bg.png" class="k-widget-21__bg" alt="bg" />
                        </div>
                        <div class="k-widget-21__data">
                            <div class="k-widget-21__legends">
                                <div class="k-widget-21__legend">
                                    <i class="k-bg-brand"></i>
                                    <span>HTML</span>
                                </div>
                                <div class="k-widget-21__legend">
                                    <i class="k-shape-bg-color-4"></i>
                                    <span>CSS</span>
                                </div>
                                <div class="k-widget-21__legend">
                                    <i class="k-shape-bg-color-3"></i>
                                    <span>Angular</span>
                                </div>
                            </div>
                            <div class="k-widget-21__chart">
                                <div class="k-widget-21__stat">+37%</div>
                                <canvas id="k_widget_technologies_chart" style="height: 110px; width: 110px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng Đơn Hàng</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="k-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="k-nav">
                                        <li class="k-nav__section k-nav__section--first">
                                            <span class="k-nav__section-text">Công Cụ Xuất</span>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-print"></i>
                                                <span class="k-nav__link-text">In</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-copy"></i>
                                                <span class="k-nav__link-text">Sao Chép</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-excel-o"></i>
                                                <span class="k-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-text-o"></i>
                                                <span class="k-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="k-nav__item">
                                            <a href="#" class="k-nav__link">
                                                <i class="k-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="k-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-20">
                        <div class="k-widget-20__title">
                            <div class="k-widget-20__label">17M</div>
                            <img class="k-widget-20__bg" src="../assets/media/misc/iconbox_bg.png" alt="bg" />
                        </div>
                        <div class="k-widget-20__data">
                            <div class="k-widget-20__chart">
                                <canvas id="k_widget_total_orders_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid k-widget">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-13-1" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Thông Báo</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-1" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-1" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Ngày Ra Mắt Keen Admin</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__label">
                                            <div class="btn btn-sm btn-label btn-bold">
                                                07 THÁNG 10, 2018
                                            </div>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Đánh Giá Tích Cực Đáng Kinh Ngạc</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__title">
                                            <div class="btn btn-sm btn-label btn-bold">
                                                17 THÁNG 11, 2018
                                            </div>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Chủ Đề Đoạt Giải Thưởng</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__label">
                                            <div class="btn btn-sm btn-label btn-bold">
                                                03 THÁNG 9, 2018
                                            </div>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-13-2" class="k-slider carousel slide" data-ride="carousel" data-interval="4000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Dự Án</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-2" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-2" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Ngày Ra Mắt Keen Admin</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__progress">
                                            <div class="k-widget-13__progress-info">
                                                <div class="k-widget-13__progress-status">
                                                    Tiến Độ
                                                </div>
                                                <div class="k-widget-13__progress-value">78%</div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar k-bg-brand" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Đạt Cột Mốc Đầu Tiên</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__progress">
                                            <div class="k-widget-13__progress-info">
                                                <div class="k-widget-13__progress-status">
                                                    Tiến Độ
                                                </div>
                                                <div class="k-widget-13__progress-value">55%</div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar k-bg-brand" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Đạt 50,000 Doanh Số</a>
                                        <div class="k-widget-13__desc">
                                            Để bắt đầu một blog, hãy nghĩ về một chủ đề và trước tiên brainstorm các cách viết chi tiết
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__progress">
                                            <div class="k-widget-13__progress-info">
                                                <div class="k-widget-13__progress-status">
                                                    Tiến Độ
                                                </div>
                                                <div class="k-widget-13__progress-value">24%</div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar k-bg-brand" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-13-3" class="k-slider carousel slide" data-ride="carousel" data-interval="12000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Lịch Trình Hôm Nay</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-3" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-3" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Cuộc Họp Trước Ra Mắt Octa</a>
                                        <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                            9:20 SÁNG - 10:00 SÁNG
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__label">
                                            <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                            <span class="k-label-font-color-2">490 E Main St. Norwich...</span>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem Bản Đồ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Cập Nhật Thiết Kế UI/UX</a>
                                        <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                            11:15 SÁNG - 12:30 CHIỀU
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__label">
                                            <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                            <span class="k-label-font-color-2">246 R St. Manhattan NY...</span>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem Bản Đồ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item k-slider__body">
                                <div class="k-widget-13">
                                    <div class="k-widget-13__body">
                                        <a class="k-widget-13__title" href="#">Cuộc Họp Tóm Tắt Báo Cáo Doanh Số</a>
                                        <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                            4:30 CHIỀU - 5:30 CHIỀU
                                        </div>
                                    </div>
                                    <div class="k-widget-13__foot">
                                        <div class="k-widget-13__label">
                                            <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                            <span class="k-label-font-color-2">492 F Sub St. Norwich CT...</span>
                                        </div>
                                        <div class="k-widget-13__toolbar">
                                            <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem Bản Đồ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
    <!--end::Hàng-->

    <!--end::Bảng Điều Khiển 1-->
</div>
<!-- end:: Nội Dung Chính -->

@endsection
<!-- end:: Nội Dung Chính -->