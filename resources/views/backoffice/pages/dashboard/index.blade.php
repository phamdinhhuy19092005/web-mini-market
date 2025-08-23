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
        <!-- Coupons -->
        <div class="col-12 mb-4">
            @if($expiringCoupons->count())
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-danger fw-bold mb-4 d-flex align-items-center">
                            Mã Giảm Giá Sắp Hết Hạn
                        </h5>

                        <!-- Swiper Slider -->
                        <div class="swiper coupon-slider">
                            <div class="swiper-wrapper">
                                @foreach($expiringCoupons as $coupon)
                                    <div class="swiper-slide">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded bg-light bg-gradient coupon-card">
                                            <!-- Thông tin mã giảm giá -->
                                            <div>
                                                <h6 class="fw-semibold text-dark mb-1">
                                                    {{ $coupon->title }}
                                                </h6>
                                                <p class="mb-1 small text-muted">
                                                    Mã: <span class="fw-monospace text-dark">{{ $coupon->code }}</span>
                                                </p>
                                                <p class="mb-1 small text-muted">
                                                    Hết hạn: <span class="fw-semibold">{{ $coupon->formatted_end_date }}</span>
                                                </p>
                                            </div>

                                            <!-- Badge ngày còn lại -->
                                            <a href="{{ route('bo.web.coupons.show', ['id' => $coupon->id]) }}" class="btn btn-danger btn-sm">
                                                Gia hạn ngày
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

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
        <div class="col-12 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Đơn hàng chờ xử lý</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="k-portlet__head-toolbar-wrapper">
                            <a href="{{ route('bo.web.orders.index') }}" class="btn btn-sm btn-light">
                                Xem tất cả
                            </a>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Số tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingOrders as $order)
                                    <tr>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ number_format($order->grand_total, 0, ',', '.') }} VND</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('bo.web.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                                Xử lý
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Không có đơn hàng chờ xử lý</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                        @foreach($topProducts->take(5) as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge badge-primary badge-pill">{{ $product->sold }}</span>
                            </li>
                        @endforeach
                    </ul>

                    @if($topProducts->count() > 5)
                        <div class="text-center mt-2">
                            <a href="{{ route('bo.web.products.index') }}" class="btn btn-link">Xem tất cả</a>
                        </div>
                    @endif
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
                                            <a class="k-widget-13__title" href="{{ route('bo.web.inventories.edit', $alert->id) }}">{{ $alert->product_name }}</a>
                                            <div class="k-widget-13__desc">
                                                Số lượng: {{ $alert->quantity }} <br>
                                                Trạng thái: {{ $alert->status }}
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-danger">{{ $alert->status }}</div>
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
                                                Số tiền: {{ number_format($transaction->amount, 0, ',', '.') }} VND
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

        <div class="col-lg-8 order-lg-1 order-xl-1">
            @if(($expiringBanner ?? collect())->count())
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div id="k-widget-slider-reviews" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                        <div class="k-slider__head">
                            <div class="k-slider__label">Banner sắp hết hạn</div>
                        </div>
                        </div>
                        <!-- Swiper Slider -->
                        <div class="swiper coupon-slider">
                            <div class="swiper-wrapper">
                                @foreach($expiringBanner as $banner)
                                    <div class="swiper-slide">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded bg-light bg-gradient coupon-card">
                                            <!-- Thông tin Banner -->
                                            <div>
                                                <h6 class="fw-semibold text-dark mb-1">
                                                    <a class="k-widget-13__title" href="{{ route('bo.web.banners.show', $banner->id) }}">
                                                        <img style="width: 190px; height:60px" src="{{ $banner->desktop_image }}" alt="">
                                                    </a>
                                                </h6>
                                                <span style="font-size: 12px; magirn-top:10px" class="fw-semibold text-danger">
                                                    {{ $banner->formatted_end_date }}
                                                </span>
                                            </div>
                                            {{-- <p class="mb-1 small text-muted">
                                                Hết hạn:
                                                <span class="fw-semibold">
                                                    {{ $banner->formatted_end_date }}
                                                </span>
                                            </p> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endif
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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

    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.coupon-slider', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    });

</script>

<style>
    .coupon-slider {
        padding: 10px 0;
    }

    /* Optional: Adjust positioning to prevent overlap */
    .swiper-button-prev {
        left: 5px;
    }
    .swiper-button-next {
        right: 5px;
    }
    .swiper-pagination-bullet-active {
        background-color: #dc3545;
    }
    .coupon-card {
        transition: transform 0.3s ease;
    }
    .coupon-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection
