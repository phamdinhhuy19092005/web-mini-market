<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateCategoryGroupResponses extends BaseViewResponses implements UpdateCategoryGroupResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.category-groups.index');
    }
}
