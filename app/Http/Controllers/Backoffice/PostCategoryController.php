<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePostCategoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostCategoryResponseContract;
use App\Http\Requests\Interfaces\StorePostCategoryRequestInterface;
use App\Http\Requests\Interfaces\UpdatePostCategoryRequestInterface;
use App\Services\PostCategoryService;
use Illuminate\Http\Request;

class PostCategoryController extends BaseController
{
    protected $postCategoryGroupService;

    public function __construct(PostCategoryService $postCategoryGroupService)
    {
        $this->postCategoryGroupService = $postCategoryGroupService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.post-categories.index');
    }

    public function create()
    {
        return view('backoffice.pages.post-categories.create');
    }

    public function store(StorePostCategoryRequestInterface $request)
    {
        $postCategory = $this->postCategoryGroupService->create($request->validated());
        return $this->responses(StorePostCategoryResponseContract::class, $postCategory);
    }

    public function show($id)
    {
        $postCategory = $this->postCategoryGroupService->show($id);
        return view('backoffice.pages.post-categories.edit', compact('postCategory'));
    }

    public function edit($id)
    {
        $postCategory = $this->postCategoryGroupService->show($id);
        return view('backoffice.pages.post-categories.edit', compact('postCategory'));
    }


    public function update(UpdatePostCategoryRequestInterface $request, $id)
    {
        $file = $request->imageFile();
        $postCategory = $this->postCategoryGroupService->update($id, $request->validated(), $file);
        return $this->responses(UpdatePostCategoryResponseContract::class, $postCategory);
    }

    public function destroy($id)
    {
        $this->postCategoryGroupService->delete($id);
        return redirect()->route('bo.web.post-categories.index');
    }
}
