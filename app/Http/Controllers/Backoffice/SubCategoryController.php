<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreSubCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateSubCategoryResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreSubCategoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateSubCategoryRequestInterface;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{
    protected $subCategoryService;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    public function index(Request $request)
    {
         return view('backoffice.pages.sub-categories.index');
    }

    public function create()
    {
        $categories = Category::all();

        return view('backoffice.pages.sub-categories.create', compact('categories'));
    }

    public function store(StoreSubCategoryRequestInterface $request)
    {
        $subCategory = $this->subCategoryService->create($request->validated());

        return $this->responses(StoreSubCategoryResponseContract::class, $subCategory);
    }

    public function show($id)
    {
        $sub_category = $this->subCategoryService->show($id);

        return view('backoffice.pages.sub-categories.show', compact('sub_category'));
    }


    public function edit($id)
    {
        $sub_category = $this->subCategoryService->show($id);
        $categories = Category::orderBy('name')->get();

        return view('backoffice.pages.sub-categories.edit', compact('sub_category', 'categories'));

    }

    public function update(UpdateSubCategoryRequestInterface $request, $id)
    {
        $this->subCategoryService->update($id, $request->validated());

        return $this->responses(UpdateSubCategoryResponseContract::class);
    }

    public function destroy($id)
    {
        $this->subCategoryService->delete($id);

        return redirect()->route('bo.web.sub-categories.index');
    }
}
