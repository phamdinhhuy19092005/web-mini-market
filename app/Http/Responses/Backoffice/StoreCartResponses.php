<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCartResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreCartResponses extends BaseViewResponses implements StoreCartResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.carts.index');
    }
}
