<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Services\CategoryGroupService;
use Illuminate\Http\Request;

class CategoryGroupController extends BaseApiController
{
    public function __construct(protected CategoryGroupService $categoryGroup)
    {
    }

    public function index(Request $request)
    {
        $categoryGroups = $this->categoryGroup->searchByAdmin($request->all());
        return $this->responses(ListCategoryGroupResponseContract::class, $categoryGroups);
    }
}
