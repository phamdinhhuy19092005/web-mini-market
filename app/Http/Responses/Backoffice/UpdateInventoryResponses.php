<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateInventoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateInventoryResponses extends BaseViewResponses implements UpdateInventoryResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.inventories.index');
    }
}
