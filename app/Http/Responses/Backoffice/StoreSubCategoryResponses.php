<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreSubCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreSubCategoryResponses extends BaseViewResponses implements StoreSubCategoryResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.sub-categories.index');
    }
}
