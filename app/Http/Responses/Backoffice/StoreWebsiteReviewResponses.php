<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreWebsiteReviewResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreWebsiteReviewResponses extends BaseViewResponses implements StoreWebsiteReviewResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.website-reviews.index');
    }
}
