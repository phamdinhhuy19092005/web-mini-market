<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListWebsiteReviewResponseContract;
use App\Services\WebsiteReviewService;
use Illuminate\Http\Request;

class WebsiteReviewController extends BaseApiController
{
    public function __construct(protected WebsiteReviewService $websiteReviewService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->websiteReviewService->searchByAdmin($request->all());
        
        return $this->responses(ListWebsiteReviewResponseContract::class, $posts);
    }
}
