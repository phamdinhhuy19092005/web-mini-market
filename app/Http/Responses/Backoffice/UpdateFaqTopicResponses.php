<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateFaqTopicResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateFaqTopicResponses extends BaseViewResponses implements UpdateFaqTopicResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.faq-topics.index');
    }
}
