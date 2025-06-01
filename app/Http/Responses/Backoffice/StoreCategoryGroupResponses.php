<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreCategoryGroupResponses extends BaseViewResponses implements StoreCategoryGroupResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.category-groups.index');
    }
}
