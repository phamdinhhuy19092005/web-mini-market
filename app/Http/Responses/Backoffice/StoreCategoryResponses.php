<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreCategoryResponses extends BaseViewResponses implements StoreCategoryResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.categories.index');
    }
}
