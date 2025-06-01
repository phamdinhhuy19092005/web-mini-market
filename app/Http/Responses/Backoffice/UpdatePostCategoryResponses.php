<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdatePostCategoryResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdatePostCategoryResponses extends BaseViewResponses implements UpdatePostCategoryResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.post-categories.index');
    }
}
