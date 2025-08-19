<?php

namespace App\Http\Controllers\Backoffice;

use App\Enum\ReviewStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\WebsiteReview;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Tính doanh thu hàng ngày (chỉ tính đơn hàng hoàn thành: order_status = 5)
        $dailyRevenue = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 5)
            ->sum('grand_total');

        // Tính tổng doanh thu (tất cả đơn hàng hoàn thành)
        $totalRevenue = Order::where('order_status', 5)
            ->sum('grand_total');

        // Tổng số đơn hàng
        $totalOrders = Order::count();

        // Sản phẩm bán chạy (lấy từ Inventory thông qua OrderItem, chỉ tính đơn hàng hoàn thành)
        $topProducts = Inventory::select('inventories.title as name')
            ->selectRaw('SUM(order_items.quantity) as sold')
            ->join('order_items', 'inventories.id', '=', 'order_items.inventory_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.order_status', 5)
            ->groupBy('inventories.id', 'inventories.title')
            ->orderByDesc('sold')
            ->take(4)
            ->get();

        // Số đơn hàng mới (hôm nay, giả sử order_status = 1 là "Chờ xử lý")
        $newOrders = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 1)
            ->count();

        // Dữ liệu biểu đồ doanh thu (theo tuần, chỉ tính đơn hàng hoàn thành)
        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('order_status', 5)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::parse($item->date)->format('D') => $item->total];
            });

        // Dữ liệu biểu đồ đơn hàng mới (theo tuần, giả sử order_status = 1)
        $newOrdersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('order_status', 1)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::parse($item->date)->format('D') => $item->count];
            });

        // Thông báo (ví dụ)
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

        // Cảnh báo tồn kho (sản phẩm có số lượng thấp)
        $inventoryAlerts = Inventory::select('title as product_name', 'stock_quantity as quantity')
            ->selectRaw('CASE WHEN stock_quantity < 10 THEN "Cảnh báo thấp" ELSE "Bình thường" END as status')
            ->selectRaw('stock_quantity / 100 * 100 as quantity_percentage')
            ->where('stock_quantity', '>', 0)
            ->orderBy('stock_quantity', 'asc')
            ->take(3)
            ->get();

        // Giao dịch gần đây (chỉ lấy đơn hàng hoàn thành)
        $recentTransactions = Order::select(
            'order_code',
            'grand_total as amount',
            'fullname as customer',
            'created_at as date'
        )
        ->where('order_status', 5)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get()
        ->map(function ($transaction) {
            $transaction->date = \Carbon\Carbon::parse($transaction->date)->format('d/m/Y');
            return $transaction;
        });

        // Đánh giá website gần đây (chỉ lấy review đang chờ xử lý)
        $recentReviews = WebsiteReview::where('status', ReviewStatusEnum::PENDING->value ?? 1) 
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('backoffice.pages.dashboard.index', compact(
            'dailyRevenue',
            'totalRevenue',
            'totalOrders',
            'topProducts',
            'newOrders',
            'revenueData',
            'newOrdersData',
            'notifications',
            'inventoryAlerts',
            'recentTransactions',
            'recentReviews' 
        ));
    }
}