<?php

namespace App\Http\Controllers\Backoffice;

class DashboardController 
{
    public function index()
    {
        return view('backoffice.pages.dashboard.index');
    }
}