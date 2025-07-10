<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListSubCategoryResponseContract;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends BaseApiController
{
    public function __construct(protected SubCategoryService $subCategoryService)
    {
    }

    public function index(Request $request)
    {
        $sub_categories = $this->subCategoryService->searchByAdmin($request->all());
        
        return $this->responses(ListSubCategoryResponseContract::class, $sub_categories);
    }
}
