<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateAttributeValueResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAttributeValueResponses extends BaseViewResponses implements UpdateAttributeValueResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.attribute-values.index');
    }
}
