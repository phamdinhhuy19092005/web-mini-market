<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCategoryResponseContract;
use App\Models\Category;
use App\Services\CategoryService;

use App\Traits\DataTableTrait;


use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    use DataTableTrait;
    
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->searchByAdmin($request->all());
        
        return $this->responses(ListCategoryResponseContract::class, $categories);
    }

    public function trashList(Request $request)
    {
        $query = Category::onlyTrashed();
        return $this->getTrashDataTable($query, 'categories');
    }
}
