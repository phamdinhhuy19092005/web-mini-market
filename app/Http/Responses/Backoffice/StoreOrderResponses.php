<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreOrderResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreOrderResponses extends BaseViewResponses implements StoreOrderResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.orders.index');
    }
}
