<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAttributeResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreAttributeResponses extends BaseViewResponses implements StoreAttributeResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.attributes.index');
    }
}
