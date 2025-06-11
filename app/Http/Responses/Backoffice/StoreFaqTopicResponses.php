<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreFaqTopicResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreFaqTopicResponses extends BaseViewResponses implements StoreFaqTopicResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.faq-topics.index');
    }
}
