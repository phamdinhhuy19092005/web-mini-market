<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAttributeValueResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreAttributeValueResponses extends BaseViewResponses implements StoreAttributeValueResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.attribute-values.index');
    }
}
