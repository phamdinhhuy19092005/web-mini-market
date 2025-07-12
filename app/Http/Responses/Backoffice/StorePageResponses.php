<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StorePageResponseContract;
use App\Http\Responses\BaseViewResponses;

class StorePageResponses extends BaseViewResponses implements StorePageResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.posts.index');
    }
}
