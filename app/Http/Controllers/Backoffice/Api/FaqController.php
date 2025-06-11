<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListFaqResponseContract;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends BaseApiController
{
    public function __construct(protected FaqService $faqService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->faqService->searchByAdmin($request->all());
        
        return $this->responses(ListFaqResponseContract::class, $posts);
    }
}
