<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->searchByAdmin($request->all());
        return $this->responses(ListCategoryGroupResponseContract::class, $categories);
    }
}
