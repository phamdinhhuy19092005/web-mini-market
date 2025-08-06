<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateOrderResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateOrderResponses extends BaseViewResponses implements UpdateOrderResponseContract
{

    public function toResponse($request)
    {
        return redirect()->route('bo.web.orders.index');
    }
}
