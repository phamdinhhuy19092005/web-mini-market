<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListSubCategoryResponseContract;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;

class SubCategoryController extends BaseApiController
{
    use DataTableTrait;
    public function __construct(protected SubCategoryService $subCategoryService)
    {
    }

    public function index(Request $request)
    {
        $sub_categories = $this->subCategoryService->searchByAdmin($request->all());
        
        return $this->responses(ListSubCategoryResponseContract::class, $sub_categories);
    }

    public function trashList(Request $request)
    {
        $query = SubCategory::onlyTrashed();
        return $this->getTrashDataTable($query, 'sub_categories');
    }
}
