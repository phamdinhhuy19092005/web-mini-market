@extends('backoffice.layouts.master')

@php
$title = __('Dashboard');

$breadcrumbs = [
    [
        // 'label' => $title,
    ],
];
@endphp


@component('backoffice.partials.breadcrumb', ['title' => $title,'items' => $breadcrumbs])
@endcomponent



<!-- begin:: Content Body -->
@section('content_body')
<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">

        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head k-portlet__head--noborder">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Author Sales</h3>
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
                                                <span class="k-nav__section-text">Export Tools</span>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-print"></i>
                                                    <span class="k-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-copy"></i>
                                                    <span class="k-nav__link-text">Copy</span>
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

                                <!--Doc: For the chart bars you can use state helper classes: k-bg-success, k-bg-info, k-bg-danger. Refer: components/custom/colors.html -->
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
                    <div class="k-portlet__head  k-portlet__head--noborder">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Technologies</h3>
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
                                                <span class="k-nav__section-text">Export Tools</span>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-print"></i>
                                                    <span class="k-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-copy"></i>
                                                    <span class="k-nav__link-text">Copy</span>
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

                                <!--Doc: For the chart legend bullet colors can be changed with state helper classes: k-bg-success, k-bg-info, k-bg-danger. Refer: components/custom/colors.html -->
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

                                    <!--Doc: For the chart initialization refer to "widgetTechnologiesChart" function in "src\theme\app\scripts\custom\dashboard.js" -->
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
                    <div class="k-portlet__head  k-portlet__head--noborder">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Total Orders</h3>
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
                                                <span class="k-nav__section-text">Export Tools</span>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-print"></i>
                                                    <span class="k-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link">
                                                    <i class="k-nav__link-icon la la-copy"></i>
                                                    <span class="k-nav__link-text">Copy</span>
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

                                    <!--Doc: For the chart initialization refer to "widgetTotalOrdersChart" function in "src\theme\app\scripts\custom\dashboard.js" -->
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
                <div class="k-portlet k-portlet--height-fluid k-widget ">
                    <div class="k-portlet__body">
                        <div id="k-widget-slider-13-1" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">Announcements</div>
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
                                            <a class="k-widget-13__title" href="#">Keen Admin Launch Day</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold">
                                                    07 OCT, 2018
                                                </div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Incredibly Positive Reviews</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__title">
                                                <div class="btn btn-sm btn-label btn-bold">
                                                    17 NOV, 2018
                                                </div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Award Winning Theme</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold">
                                                    03 SEP, 2018
                                                </div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a>
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
                                <div class="k-slider__label">Projects</div>
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
                                            <a class="k-widget-13__title" href="#">Keen Admin Launch Day</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status">
                                                        Progress
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
                                            <a class="k-widget-13__title" href="#">First Milestone Achivement</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status">
                                                        Progress
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
                                            <a class="k-widget-13__title" href="#">Reached 50,000 sales</a>
                                            <div class="k-widget-13__desc">
                                                To start a blog, think of a topic about and first brainstorm party is ways to write details
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status">
                                                        Progress
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
                                <div class="k-slider__label">Today's Schedule</div>
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
                                            <a class="k-widget-13__title" href="#">Octa Pre-Launch Meeting</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                                9:20AM - 10:00AM
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                                <span class="k-label-font-color-2">490 E Main St. Norwich...</span>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">UI/UX Design Updates</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                                11:15AM - 12:30PM
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                                <span class="k-label-font-color-2">246 R St. Manhattan NY...</span>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Sales Report Summary Meet-up</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand">
                                                4:30PM - 5:30PM
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <i class="fa fa-map-marker-alt k-label-font-color-2"></i>
                                                <span class="k-label-font-color-2">492 F Sub St. Norwich CT...</span>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a>
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
        <!--end::Row-->

        <!--end::Dashboard 1-->
    </div>
    <!-- end:: Content Body -->

@endsection
<!-- end:: Content Body -->
