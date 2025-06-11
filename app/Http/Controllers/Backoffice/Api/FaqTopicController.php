<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListFaqTopicResponseContract;
use App\Services\FaqTopicService;
use Illuminate\Http\Request;

class FaqTopicController extends BaseApiController
{
    public function __construct(protected FaqTopicService $faqTopicService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->faqTopicService->searchByAdmin($request->all());
        
        return $this->responses(ListFaqTopicResponseContract::class, $posts);
    }
}
