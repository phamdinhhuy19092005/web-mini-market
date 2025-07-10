<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreInventoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreInventoryResponses extends BaseViewResponses implements StoreInventoryResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.inventories.index');
    }
}
