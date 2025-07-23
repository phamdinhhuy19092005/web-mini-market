<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateWebsiteReviewResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateWebsiteReviewResponses extends BaseViewResponses implements UpdateWebsiteReviewResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.website-reviews.index');
    }
}
