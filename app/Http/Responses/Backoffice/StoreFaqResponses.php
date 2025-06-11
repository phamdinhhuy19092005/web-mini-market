<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreFaqResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreFaqResponses extends BaseViewResponses implements StoreFaqResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.faqs.index');
    }
}
