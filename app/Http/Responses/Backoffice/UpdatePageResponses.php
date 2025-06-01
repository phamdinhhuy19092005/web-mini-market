<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdatePageResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdatePageResponses extends BaseViewResponses implements UpdatePageResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.pages.index');
    }
}
