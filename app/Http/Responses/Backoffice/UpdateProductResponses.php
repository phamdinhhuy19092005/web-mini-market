<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateProductResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateProductResponses extends BaseViewResponses implements UpdateProductResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.products.index');
    }
}
