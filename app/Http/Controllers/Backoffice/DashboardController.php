<?php

namespace App\Http\Controllers\Backoffice;

class DashboardController 
{
    public function index()
    {
        $totalOrders = \App\Models\Order::count();
        return view('backoffice.pages.dashboard.index', compact('totalOrders'));
    }
}