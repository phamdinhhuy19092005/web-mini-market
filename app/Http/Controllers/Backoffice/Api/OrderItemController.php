<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends BaseApiController
{
    public function index(Request $request)
    {
        $query = OrderItem::query();

        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        return response()->json($query->paginate(20));
    }
}
