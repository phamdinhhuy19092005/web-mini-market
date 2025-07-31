<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateCartResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateCartResponses extends BaseViewResponses implements UpdateCartResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.carts.index');
    }
}
