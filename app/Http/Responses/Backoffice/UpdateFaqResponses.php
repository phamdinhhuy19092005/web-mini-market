<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateFaqResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateFaqResponses extends BaseViewResponses implements UpdateFaqResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.faqs.index');
    }
}
