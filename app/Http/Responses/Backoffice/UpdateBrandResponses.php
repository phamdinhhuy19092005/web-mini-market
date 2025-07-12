<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateBrandResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateBrandResponses extends BaseViewResponses implements UpdateBrandResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.brands.index');
    }
}
