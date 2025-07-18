<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Models\CategoryGroup;
use App\Services\CategoryGroupService;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;

class CategoryGroupController extends BaseApiController
{
    use DataTableTrait;

    public function __construct(protected CategoryGroupService $categoryGroup)
    {
    }

    public function index(Request $request)
    {
        $categoryGroups = $this->categoryGroup->searchByAdmin($request->all());
        
        return $this->responses(ListCategoryGroupResponseContract::class, $categoryGroups);
    }

    public function trashList(Request $request)
    {
        $query = CategoryGroup::onlyTrashed();
        return $this->getTrashDataTable($query, 'category-groups');
    }
}