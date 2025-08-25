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
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Doanh thu ngày</h3>
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
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng doanh thu</h3>
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
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng đơn hàng</h3>
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

        <!-- Total Products -->
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tổng số lượng sản phẩm</h3>
                    </div>
                </div>
                <div class="k-portlet__body k-portlet__body--fluid">
                    <div class="k-widget-20">
                        <div class="k-widget-20__title">
                            <div class="k-widget-20__label">{{ number_format($totalProducts) }}</div>
                            <img class="k-widget-20__bg" src="{{ asset('assets/media/misc/iconbox_bg.png') }}" alt="bg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Combined Widget -->
        <div class="col-lg-12">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Thống kê & Cảnh báo</h3>
                    </div>
                </div>
                <div class="k-portlet__body">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs nav-tabs-line mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-top-products" role="tab">
                                Sản phẩm bán chạy
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-inventory-alerts" role="tab">
                                Cảnh báo kho
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-recent-transactions" role="tab">
                                Giao dịch gần đây
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-pending-orders" role="tab">
                                Đơn hàng chờ xử lý
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content">

                        <!-- Top Products -->
                        <div class="tab-pane fade show active" id="tab-top-products" role="tabpanel">
                            <div class="row">
                            <!-- Chart bên trái -->
                            <div class="col-md-6">
                                <div style="height:350px">
                                    <canvas id="topProductsChart"></canvas>
                                </div>
                            </div>

                            <!-- Danh sách sản phẩm bên phải -->
                            <div class="col-md-6">
                                <h5 class="mb-3">Top Sản phẩm bán chạy</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topProducts as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sold }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        </div>

                        <!-- Inventory Alerts (dạng danh sách) -->
                        <div class="tab-pane fade" id="tab-inventory-alerts" role="tabpanel">
                            <div class="row">
                                <div class="swiper inventory-slider">
                                    <div class="swiper-wrapper">
                                        @foreach($inventoryAlerts as $alert)
                                            <div class="swiper-slide">
                                                <div class="p-3 border badge-danger rounded">
                                                    <h6>{{ $alert->product_name }}</h6>
                                                    <p>Số lượng: {{ $alert->quantity }}</p>
                                                    <a href="{{ route('bo.web.inventories.edit', $alert->id) }}" class="btn btn-sm btn-light">Xem</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Transactions (dạng table) -->
                        <div class="tab-pane fade" id="tab-recent-transactions" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Mã đơn</th>
                                            <th>Khách hàng</th>
                                            <th>Số tiền</th>
                                            <th>Ngày</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->order_code }}</td>
                                                <td>{{ $transaction->customer }}</td>
                                                <td>{{ number_format($transaction->amount, 0, ',', '.') }} VND</td>
                                                <td>{{ $transaction->date }}</td>

                                                <td>
                                                    <a href="{{ route('bo.web.orders.show', $transaction->id) }}" class="btn btn-sm btn-outline-primary">Xem đơn hàng</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Không có giao dịch gần đây</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pending Orders -->
                        <div class="tab-pane fade" id="tab-pending-orders" role="tabpanel">
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
                                <div class="text-right mt-2">
                                    <a href="{{ route('bo.web.orders.index') }}" class="btn btn-sm btn-light">
                                        Xem tất cả
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Tab Contents -->
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
                                                <div class="btn btn-sm btn-label btn-bold">---</div>
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
        <div class="col-lg-6 col-xl-6">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Biểu đồ doanh thu</h3>
                    </div>
                </div>
                <div class="k-portlet__body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- New Orders Chart -->
        <div class="col-lg-6 col-xl-6">
            <div class="k-portlet k-portlet--height-fluid">
                <div class="k-portlet__head k-portlet__head--noborder">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Biểu đồ đơn hàng mới</h3>
                    </div>
                </div>
                <div class="k-portlet__body">
                    <canvas id="newOrdersChart"></canvas>
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
document.addEventListener('DOMContentLoaded', function () {

    // Revenue Chart
    const revenueChartEl = document.getElementById('revenueChart');
    if (revenueChartEl) {
        new Chart(revenueChartEl, {
            type: 'bar',
            data: {
                labels: @json($revenueData->keys() ?? []),
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: @json($revenueData->values() ?? []),
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw.toLocaleString() + ' VND';
                            }
                        }
                    },
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // New Orders Chart
    const newOrdersChartEl = document.getElementById('newOrdersChart');
    if (newOrdersChartEl) {
        new Chart(newOrdersChartEl, {
            type: 'line',
            data: {
                labels: @json($newOrdersData->keys() ?? []),
                datasets: [{
                    label: 'Số đơn hàng mới',
                    data: @json($newOrdersData->values() ?? []),
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // Top Products Chart
    const topProductsChartEl = document.getElementById('topProductsChart');
    if (topProductsChartEl) {
        new Chart(topProductsChartEl, {
            type: 'pie',
            data: {
                labels: @json($topProducts->take(5)->pluck('name')),
                datasets: [{
                    data: @json($topProducts->take(5)->pluck('sold')),
                    backgroundColor: [
                        '#E1E1EF',
                        '#FEB822',
                        '#5867DD',
                        '#1EC9B7',
                        '#FD397A'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return label + ': ' + value;
                            }
                        }
                    }
                }
            }
        });
    }

    // Swiper
    const swiperEl = document.querySelector('.coupon-slider');
    if (swiperEl) {
        new Swiper(swiperEl, {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 15 },
                1024: { slidesPerView: 3, spaceBetween: 20 },
            },
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
        });
    }

    new Swiper('.inventory-slider', {
        slidesPerView: 3,
        spaceBetween: 15,
        loop: true,
        autoplay: { delay: 5000 },
        pagination: false,
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
