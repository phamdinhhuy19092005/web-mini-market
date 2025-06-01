<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateCategoryResponses extends BaseViewResponses implements UpdateCategoryResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.categories.index');
    }
}
