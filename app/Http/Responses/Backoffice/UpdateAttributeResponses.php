<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateAttributeResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAttributeResponses extends BaseViewResponses implements UpdateAttributeResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.attributes.index');
    }
}
