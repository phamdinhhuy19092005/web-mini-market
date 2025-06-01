<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StorePostResponseContract;
use App\Http\Responses\BaseViewResponses;

class StorePostResponses extends BaseViewResponses implements StorePostResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.posts.index');
    }
}
