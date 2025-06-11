<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListPostCategoryResponseContract;
use App\Services\PostCategoryService;
use Illuminate\Http\Request;

class PostCategoryController extends BaseApiController
{
    public function __construct(protected PostCategoryService $postCategoryService)
    {
    }

    public function index(Request $request)
    {
        $postCategories = $this->postCategoryService->searchByAdmin($request->all());
        
        return $this->responses(ListPostCategoryResponseContract::class, $postCategories);
    }
}
