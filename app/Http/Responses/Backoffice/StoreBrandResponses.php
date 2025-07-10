<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreBrandResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreBrandResponses extends BaseViewResponses implements StoreBrandResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.brands.index');
    }
}
