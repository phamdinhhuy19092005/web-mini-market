<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateSubCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateSubCategoryResponses extends BaseViewResponses implements UpdateSubCategoryResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.sub-categories.index');
    }
}
