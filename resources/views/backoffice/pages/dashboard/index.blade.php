@extends('backoffice.layouts.master')

@php
    $title = __('Bảng Điều Khiển Mini Mart');
    $breadcrumbs = [
        ['label' => $title],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <!--begin::Hàng-->
    <div class="row g-4">
        <!-- Thống kê doanh thu -->
        <div class="col-lg-12">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__head k-portlet__head--noborder p-4">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title fw-bold text-primary">Doanh Thu Hôm Nay</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="k-nav">
                                    <li class="k-nav__item">
                                        <a href="#" class="k-nav__link">
                                            <i class="k-nav__link-icon fas fa-file-export"></i>
                                            <span class="k-nav__link-text">Xuất Excel</span>
                                        </a>
                                    </li>
                                    <li class="k-nav__item">
                                        <a href="#" class="k-nav__link">
                                            <i class="k-nav__link-icon fas fa-file-pdf"></i>
                                            <span class="k-nav__link-text">Xuất PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body p-4">
                    <div class="k-widget-1">
                        <div class="k-widget-19__title d-flex align-items-center">
                            <div class="k-widget-19__label display-3 fw-bold text-success">
                                <small>VNĐ</small> {{ number_format($dailyRevenue, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="k-widget-19__data mt-4">
                            <canvas id="k_widget_revenue_chart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tổng doanh thu -->
        <div class="col-lg-12">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__head k-portlet__head--noborder p-4">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title fw-bold text-primary">Tổng Doanh Thu</h3>
                    </div>
                    <div class="k-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="k-nav">
                                    <li class="k-nav__item">
                                        <a href="#" class="k-nav__link">
                                            <i class="k-nav__link-icon fas fa-file-export"></i>
                                            <span class="k-nav__link-text">Xuất Excel</span>
                                        </a>
                                    </li>
                                    <li class="k-nav__item">
                                        <a href="#" class="k-nav__link">
                                            <i class="k-nav__link-icon fas fa-file-pdf"></i>
                                            <span class="k-nav__link-text">Xuất PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="k-portlet__body p-4">
                    <div class="k-widget-1">
                        <div class="k-widget-19__title d-flex align-items-center">
                            <div class="k-widget-19__label display-3 fw-bold text-success">
                                <small>VNĐ</small> {{ number_format($totalRevenue, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sản phẩm bán chạy -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm rounded-3 border-0 h-100">
                <div class="card-header border-0 bg-gradient bg-light p-4 d-flex justify-content-between align-items-center">
                    <h3 class="k-slider__label fw-bold text-primary">Sản Phẩm Bán Chạy</h3>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Đã bán</th>
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
        </div>

        <!-- Người dùng -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm rounded-3 border-0 h-100">
                <div class="card-header border-0 bg-gradient bg-light p-4 d-flex justify-content-between align-items-center">
                    <h3 class="card-title fw-bold text-primary mb-0">Người dùng mới</h3>
                </div>
                <div class="card-body p-4">
                    <div class="k-widget-1">
                        <div class="k-widget-20__title mb-3">
                            <div class="display-4 fw-bold text-info">{{ $newOrders }}</div>
                        </div>
                        <div class="k-widget-20__data">
                            <canvas id="k_widget_new_orders_chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Đánh giá website -->
        <div class="col-lg-4 col-md-6">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__body p-4">
                    <div id="k-widget-slider-reviews" class="k-slider carousel slide" data-ride="carousel" data-interval="6000">
                        <div class="k-slider__head d-flex justify-content-between">
                            <div class="k-slider__label fw-bold text-primary">Đánh Giá Website</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-reviews" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-reviews" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner mt-3">
                            @foreach($recentReviews as $review)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title fw-bold" href="#">{{ $review->name }}</a>
                                            <div class="k-widget-13__desc text-muted">
                                                {{ $review->comment }}<br>
                                                Đánh giá: {{ $review->rating }} sao
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot mt-2">
                                            <span class="badge bg-success" style="color: #fff">{{ $review->created_at }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông báo -->
        <div class="col-lg-4 col-md-6">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__body p-4">
                    <div id="k-widget-slider-notifications" class="k-slider carousel slide" data-ride="carousel" data-interval="6000">
                        <div class="k-slider__head d-flex justify-content-between">
                            <div class="k-slider__label fw-bold text-primary">Thông Báo</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-notifications" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-notifications" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner mt-3">
                            @foreach($notifications as $notification)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title fw-bold" href="#">{{ $notification->title }}</a>
                                            <div class="k-widget-13__desc text-muted">{{ $notification->description }}</div>
                                        </div>
                                        <div class="k-widget-13__foot mt-2">
                                            <span class="badge bg-primary" style="color: #ffff">{{ $notification->date }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tồn kho -->
        <div class="col-lg-4 col-md-6">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__body p-4">
                    <div id="k-widget-slider-inventory" class="k-slider carousel slide" data-ride="carousel" data-interval="5000">
                        <div class="k-slider__head d-flex justify-content-between">
                            <div class="k-slider__label fw-bold text-primary">Tình Trạng Tồn Kho</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-inventory" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-inventory" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner mt-3">
                            @foreach($inventoryAlerts as $alert)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title fw-bold" href="#">{{ $alert->product_name }}</a>
                                            <div class="k-widget-13__desc text-muted">
                                                Số lượng: {{ $alert->quantity }} ({{ $alert->status }})
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot mt-2">
                                            <div class="progress">
                                                <div class="progress-bar {{ $alert->quantity < 10 ? 'bg-danger' : 'bg-warning' }}"
                                                     role="progressbar"
                                                     style="width: {{ $alert->quantity_percentage }}%"
                                                     aria-valuenow="{{ $alert->quantity_percentage }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
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

        <!-- Lịch sử giao dịch -->
        <div class="col-lg-4 col-md-6">
            <div class="k-portlet k-portlet--height-fluid shadow-sm rounded-3 border-0">
                <div class="k-portlet__body p-4">
                    <div id="k-widget-slider-transactions" class="k-slider carousel slide" data-ride="carousel" data-interval="7000">
                        <div class="k-slider__head d-flex justify-content-between">
                            <div class="k-slider__label fw-bold text-primary">Giao Dịch Gần Đây</div>
                            <div class="k-slider__nav">
                                <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-transactions" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-transactions" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-inner mt-3">
                            @foreach($recentTransactions as $transaction)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title fw-bold" href="#">Mã GD: {{ $transaction->order_code }}</a>
                                            <div class="k-widget-13__desc text-muted">
                                                Tổng: {{ number_format($transaction->amount, 0, ',', '.') }} VNĐ
                                                <br>Khách hàng: {{ $transaction->customer ?? 'Khách vãng lai' }}
                                            </div>
                                        </div>
                                        <div class="k-widget-13__foot mt-2">
                                            <span class="badge bg-info" style="color: #ffff">{{ $transaction->date }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Hàng-->
</div>

<style>
    .k-portlet {
        background: white;
        transition: all 0.3s ease;
        min-height: 200px;
    }
    .k-portlet:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    .k-portlet__head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        max-width: 100%;
        overflow: hidden;
        box-sizing: border-box;
    }
    .k-portlet__head-label {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .k-portlet__head-toolbar {
        flex-shrink: 0;
    }
    .k-portlet__head-toolbar .btn {
        padding: 0.25rem 0.5rem;
    }
    .text-primary { color: #007bff !important; }
    .text-success { color: #28a745 !important; }
    .text-info { color: #17a2b8 !important; }
    .fas { font-size: 1.2rem; }
    .carousel-control-prev,
    .carousel-control-next {
        width: 30px;
        background: rgba(0,0,0,0.1);
        border-radius: 50%;
    }
    .k-portlet--revenue {
        min-height: 600px;
    }
    .k-widget-19__label {
        font-size: 3rem;
    }
    .k-widget-19__data canvas {
        max-height: 400px !important;
    }
    @media (max-width: 992px) {
        .k-portlet--revenue {
            min-height: 400px;
        }
        .k-widget-19__data canvas {
            max-height: 300px !important;
        }
    }
    @media (max-width: 768px) {
        .k-portlet__head {
            flex-direction: column;
            align-items: flex-start;
        }
        .k-portlet__head-toolbar {
            margin-top: 0.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        new Chart(document.getElementById('k_widget_revenue_chart'), {
            type: 'line',
            data: {
                labels: [@foreach($revenueData as $day => $value)"{{ $day }}",@endforeach],
                datasets: [{
                    label: 'Doanh thu',
                    data: [@foreach($revenueData as $value){{ $value }},@endforeach],
                    borderColor: '#007bff',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' VNĐ';
                            }
                        }
                    }
                }
            }
        });

        // Top Products Chart
        new Chart(document.getElementById('k_widget_top_products_chart'), {
            type: 'doughnut',
            data: {
                labels: [@foreach($topProducts as $product)"{{ $product->name }}",@endforeach],
                datasets: [{
                    data: [@foreach($topProducts as $product){{ $product->sold }},@endforeach],
                    backgroundColor: ['#007bff', '#28a745', '#17a2b8', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // New Orders Chart
        new Chart(document.getElementById('k_widget_new_orders_chart'), {
            type: 'bar',
            data: {
                labels: [@foreach($newOrdersData as $day => $value)"{{ $day }}",@endforeach],
                datasets: [{
                    label: 'Đơn hàng mới',
                    data: [@foreach($newOrdersData as $value){{ $value }},@endforeach],
                    backgroundColor: '#17a2b8'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection