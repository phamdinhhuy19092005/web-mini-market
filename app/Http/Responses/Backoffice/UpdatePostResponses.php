<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdatePostResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdatePostResponses extends BaseViewResponses implements UpdatePostResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.posts.index');
    }
}
