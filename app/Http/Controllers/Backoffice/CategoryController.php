<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCategoryRequestInterface;

use App\Models\CategoryGroup;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
         return view('backoffice.pages.categories.index');
    }

    public function create()
    {
        $categoryGroups = CategoryGroup::all();

        return view('backoffice.pages.categories.create', compact('categoryGroups'));
    }

    public function store(StoreCategoryRequestInterface $request)
    {
        $category = $this->categoryService->create($request->validated());

        return $this->responses(StoreCategoryResponseContract::class, $category);
    }

    public function show($id)
    {
        $category = $this->categoryService->show($id);

        return view('backoffice.pages.categories.show', compact('category'));
    }


    public function edit($id)
    {
        $category = $this->categoryService->show($id);
        $categoryGroups = CategoryGroup::all();

        return view('backoffice.pages.categories.edit', compact('category', 'categoryGroups'));

    }

    public function update(UpdateCategoryRequestInterface $request, $id)
    {
        $this->categoryService->update($id, $request->validated());

        return $this->responses(UpdateCategoryResponseContract::class);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('bo.web.categories.index');
    }
}
