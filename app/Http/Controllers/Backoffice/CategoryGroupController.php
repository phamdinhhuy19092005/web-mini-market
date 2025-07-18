<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCategoryGroupResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreCategoryGroupRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCategoryGroupRequestInterface;
use App\Models\CategoryGroup;
use App\Services\CategoryGroupService;
use Illuminate\Http\Request;

class CategoryGroupController extends BaseController
{
    protected $categoryGroupService;

    public function __construct(CategoryGroupService $categoryGroupService)
    {
        $this->categoryGroupService = $categoryGroupService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.category-groups.index');
    }

    public function create()
    {
        return view('backoffice.pages.category-groups.create');
    }

    public function store(StoreCategoryGroupRequestInterface $request)
    {
        $categoryGroup = $this->categoryGroupService->create($request->validated());

        return $this->responses(StoreCategoryGroupResponseContract::class, $categoryGroup);
    }

    public function show($id)
    {
        $categoryGroups = $this->categoryGroupService->show($id);

        return view('backoffice.pages.category-groups.index', compact('categoryGroups'));
    }

    public function edit($id)
    {
        $categoryGroup = $this->categoryGroupService->show($id);

        return view('backoffice.pages.category-groups.edit', compact('categoryGroup'));
    }

    public function update(UpdateCategoryGroupRequestInterface $request, $id)
    {
        $this->categoryGroupService->update($id, $request->validated());

        return $this->responses(UpdateCategoryGroupResponseContract::class);
    }

    public function destroy($id)
    {
        $this->categoryGroupService->delete($id);
        
        return redirect()->route('bo.web.category-groups.index');
    }

    public function trash()
    {
        return view('backoffice.pages.category-groups.trash');
    }

    public function restore($id)
    {
        $categoryGroup = CategoryGroup::withTrashed()->findOrFail($id);
        $categoryGroup->restore();

        return redirect()->back()->with('success', 'Nhóm danh mục đã được khôi phục thành công.');
    }
}
