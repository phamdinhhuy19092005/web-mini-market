@extends('backoffice.layouts.master')

@php
$title = __('Dashboard');

$breadcrumbs = [
    [
        // 'label' => $title,
    ],
];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <!--begin::Row-->
    <div class="row">
        <!-- Daily Revenue -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Doanh thu ngày</h3>
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
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-print"></i><span class="k-nav__link-text">Print</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-copy"></i><span class="k-nav__link-text">Copy</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-excel-o"></i><span class="k-nav__link-text">Excel</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-text-o"></i><span class="k-nav__link-text">CSV</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-pdf-o"></i><span class="k-nav__link-text">PDF</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-19">
                        <div class="k-widget-19__title">
                            <div class="k-widget-19__label">{{ number_format($dailyRevenue, 0, ',', '.') }} <small>VND</small></div>
                            <img class="k-widget-19__bg" src="{{ asset('assets/media/misc/iconbox_bg.png') }}" alt="bg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng doanh thu</h3>
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
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-print"></i><span class="k-nav__link-text">Print</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-copy"></i><span class="k-nav__link-text">Copy</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-excel-o"></i><span class="k-nav__link-text">Excel</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-text-o"></i><span class="k-nav__link-text">CSV</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-pdf-o"></i><span class="k-nav__link-text">PDF</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-19">
                        <div class="k-widget-19__title">
                            <div class="k-widget-19__label">{{ number_format($totalRevenue, 0, ',', '.') }} <small>VND</small></div>
                            <img class="k-widget-19__bg" src="{{ asset('assets/media/misc/iconbox_bg.png') }}" alt="bg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng đơn hàng</h3>
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
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-print"></i><span class="k-nav__link-text">Print</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-copy"></i><span class="k-nav__link-text">Copy</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-excel-o"></i><span class="k-nav__link-text">Excel</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-text-o"></i><span class="k-nav__link-text">CSV</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-pdf-o"></i><span class="k-nav__link-text">PDF</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-20">
                        <div class="k-widget-20__title">
                            <div class="k-widget-20__label">{{ number_format($totalOrders) }}</div>
                            <img class="k-widget-20__bg" src="{{ asset('assets/media/misc/iconbox_bg.png') }}" alt="bg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Order Value -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Giá trị đơn hàng trung bình</h3>
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
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-print"></i><span class="k-nav__link-text">Print</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-copy"></i><span class="k-nav__link-text">Copy</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-excel-o"></i><span class="k-nav__link-text">Excel</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-text-o"></i><span class="k-nav__link-text">CSV</span></a></li>
                                        <li class="k-nav__item"><a href="#" class="k-nav__link"><i class="k-nav__link-icon la la-file-pdf-o"></i><span class="k-nav__link-text">PDF</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-19">
                        <div class="k-widget-19__title">
                            <div class="k-widget-19__label">{{ number_format($averageOrderValue, 0, ',', '.') }} <small>VND</small></div>
                            <img class="k-widget-19__bg" src="{{ asset('assets/media/misc/iconbox_bg.png') }}" alt="bg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Sản phẩm bán chạy</h3>
                    </div>
                </div>
                <div class="k-portlet__body">
                    <ul class="list-group">
                        @foreach($topProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge badge-primary badge-pill">{{ $product->sold }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-notifications" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Thông báo</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-notifications" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-notifications" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            @foreach($notifications as $index => $notification)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">{{ $notification->title }}</a>
                                            <div class="k-widget-13__desc">{{ $notification->description }}</div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold">{{ $notification->date }}</div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Alerts -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-inventory" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Cảnh báo tồn kho</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-inventory" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-inventory" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            @foreach($inventoryAlerts as $index => $alert)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">{{ $alert->product_name }}</a>
                                            <div class="k-widget-13__desc">
                                                Số lượng: {{ $alert->quantity }} <br>
                                                Trạng thái: {{ $alert->status }}
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label {{ $alert->status == 'Cảnh báo thấp' ? 'btn-danger' : 'btn-success' }}">{{ $alert->status }}</div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="{{ route('bo.web.inventories.edit', $alert->id) }}" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-transactions" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Giao dịch gần đây</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-transactions" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-widget-slider-nav-next carousel-control-next" href="#k-widget-slider-transactions" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            @foreach($recentTransactions as $index => $transaction)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">{{ $transaction->order_code }}</a>
                                            <div class="k-widget-13__desc">
                                                Khách hàng: {{ $transaction->customer }} <br>
                                                Số tiền: VND {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold">{{ $transaction->date }}</div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="{{ route('bo.web.orders.show', $transaction->id) }}" class="btn btn-default btn-sm btn-bold btn-upper">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid k-widget-13">
                <div class="k-portlet__body">
                    <div id="k-widget-slider-reviews" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Đánh giá gần đây</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-reviews" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-reviews" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner">
                            @foreach($recentReviews as $index => $review)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">{{ $review->name ?? 'Khách' }}</a>
                                            <div class="k-widget-13__desc">
                                                {{ Str::limit($review->comment, 50) }} <br>
                                                Đánh giá: {{ $review->rating }} sao
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold">{{ $review->status }}</div>
                                            </div>
                                            <div class="k-widget-13__toolbar">
                                                <a href="{{ route('bo.web.website-reviews.edit', $review->id) }}" class="btn bg-warning btn-sm btn-bold btn-upper" style="color: #ffff">Chờ duyệt</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="col-lg-12 col-xl-6 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Biểu đồ doanh thu</h3>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-20__chart">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Orders Chart -->
        <div class="col-lg-12 col-xl-6 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Biểu đồ đơn hàng mới</h3>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-20__chart">
                        <canvas id="newOrdersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
</div>
<!-- end:: Content Body -->

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: @json($revenueData->keys()),
            datasets: [{
                label: 'Doanh thu',
                data: @json($revenueData->values()),
                backgroundColor: '#007bff',
                borderColor: '#0056b3',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VND)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Ngày'
                    }
                }
            }
        }
    });

    // New Orders Chart
    new Chart(document.getElementById('newOrdersChart'), {
        type: 'line',
        data: {
            labels: @json($newOrdersData->keys()),
            datasets: [{
                label: 'Số đơn hàng mới',
                data: @json($newOrdersData->values()),
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: '#28a745',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số đơn hàng'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Ngày'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
