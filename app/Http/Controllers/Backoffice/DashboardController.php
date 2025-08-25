<?php

namespace App\Http\Controllers\Backoffice;

use App\Enum\ReviewStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\WebsiteReview;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get time range filter from request (default: today)
        $timeRange = request()->input('time_range', 'today');
        $startDate = $this->getStartDate($timeRange);
        $endDate = Carbon::now();

        // Daily revenue (completed orders: order_status = 5)
        $dailyRevenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 5)
            ->sum('grand_total');

        // Total revenue (all completed orders)
        $totalRevenue = Order::where('order_status', 5)
            ->sum('grand_total');

        // Total orders
        $totalOrders = Order::count();

        // Total customers
        // $totalCustomers = User::where('role', 'customer')->count();

        // Average order value (completed orders)
        $averageOrderValue = Order::where('order_status', 5)
            ->avg('grand_total') ?? 0;

        // Top products
        $topProducts = Inventory::select('inventories.title as name')
            ->selectRaw('SUM(order_items.quantity) as sold')
            ->join('order_items', 'inventories.id', '=', 'order_items.inventory_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.order_status', 5)
            ->groupBy('inventories.id', 'inventories.title')
            ->orderByDesc('sold')
            ->take(5)
            ->get();

        // New orders (fixed to return a collection)
        $newOrders = Order::select('order_code', 'grand_total as total_amount', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Revenue data for chart
        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 5)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::parse($item->date)->format('D') => $item->total];
            });

        // New orders data for chart
        $newOrdersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 1)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::parse($item->date)->format('D') => $item->count];
            });

        // Notifications
        $notifications = [
            (object)[
                'title' => 'Khuyến mãi mới',
                'description' => 'Khuyến mãi 20% cho tất cả sản phẩm sữa từ 20-25/8',
                'date' => '20/08/2025'
            ],
            (object)[
                'title' => 'Cập nhật kho',
                'description' => 'Nhập kho lô hàng nước ngọt mới',
                'date' => '19/08/2025'
            ]
        ];

        // Inventory alerts
        $inventoryAlerts = Inventory::select(
            'id',
            'title as product_name',
            'stock_quantity as quantity'
        )
        ->selectRaw('CASE WHEN stock_quantity < 10 THEN "Cảnh báo thấp" ELSE "Bình thường" END as status')
        ->selectRaw('stock_quantity / 100 * 100 as quantity_percentage')
        ->where('stock_quantity', '>', 0)
        ->orderBy('stock_quantity', 'asc')
        ->get();

        // Recent transactions
        $recentTransactions = Order::select(
            'id',
            'order_code',
            'grand_total as amount',
            'fullname as customer',
            'created_at as date'
        )
        ->where('order_status', 5)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get()
        ->map(function ($transaction) {
            $transaction->date = Carbon::parse($transaction->date)->format('d/m/Y');
            return $transaction;
        });

        // Recent reviews with actions
        $recentReviews = WebsiteReview::where('status', ReviewStatusEnum::PENDING->value ?? 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

             $recentReviews = WebsiteReview::select('id', 'name', 'comment', 'rating', 'created_at')
            ->where('status', ReviewStatusEnum::PENDING->value ?? 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $expiringCoupons = Coupon::select('id','title', 'code', 'end_date')
            ->where('status', 1)
            ->whereDate('end_date', '>=', Carbon::today())
            ->whereDate('end_date', '<=', Carbon::today()->addDays(7))
            ->orderBy('end_date', 'asc')
            ->get()
            ->map(function ($coupon) {
                $daysLeft = Carbon::today()->diffInDays(Carbon::parse($coupon->end_date), false);
                $coupon->days_left = $daysLeft;
                $coupon->formatted_end_date = Carbon::parse($coupon->end_date)->format('d/m/Y');
                return $coupon;
            });

        $expiringBanner = Banner::select('id','name', 'desktop_image', 'end_at')
            ->where('status', 1)
            ->whereDate('end_at', '>=', Carbon::today())
            ->whereDate('end_at', '<=', Carbon::today()->addDays(7))
            ->orderBy('end_at', 'asc')
            ->get()
            ->map(function ($banner) {
                $daysLeft = Carbon::today()->diffInDays(Carbon::parse($banner->end_at), false);
                $banner->days_left = $daysLeft;
                $banner->formatted_end_date = Carbon::parse($banner->end_at)->format('d/m/Y');
                return $banner;
            });

        $pendingOrders = Order::select('id','order_code','fullname','grand_total','created_at')
            ->where('order_status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalProducts = Inventory::count();

        return view('backoffice.pages.dashboard.index', compact(
            'dailyRevenue',
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'topProducts',
            'newOrders',
            'revenueData',
            'newOrdersData',
            'notifications',
            'inventoryAlerts',
            'recentTransactions',
            'recentReviews',
            'expiringCoupons',
            'expiringBanner',
            'pendingOrders',
            'totalProducts',
            'timeRange'
        ));
    }

    private function getStartDate($timeRange)
    {
        $validRanges = ['today', 'week', 'month', 'custom'];
        $timeRange = in_array($timeRange, $validRanges) ? $timeRange : 'today';

        switch ($timeRange) {
            case 'week':
                return Carbon::now()->startOfWeek();
            case 'month':
                return Carbon::now()->startOfMonth();
            case 'custom':
                return Carbon::parse(request()->input('start_date', Carbon::now()->startOfMonth()));
            default:
                return Carbon::today();
        }
    }
}
