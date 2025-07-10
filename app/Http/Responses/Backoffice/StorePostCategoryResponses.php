<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StorePostCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class StorePostCategoryResponses extends BaseViewResponses implements StorePostCategoryResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.post-categories.index');
    }
}
