<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePageResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePageResponseContract;
use App\Enum\PageDisplayInEnum;
use App\Http\Requests\Interfaces\StorePageRequestInterface;
use App\Http\Requests\Interfaces\UpdatePageRequestInterface;
use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.pages.index');
    }

    public function create()
    {
        $pageDisplayInEnumLabels = PageDisplayInEnum::labels();
        return view('backoffice.pages.pages.create', compact('pageDisplayInEnumLabels'));
    }

    public function store(StorePageRequestInterface $request)
    {
        $post = $this->pageService->create($request->validated());
        return $this->responses(StorePageResponseContract::class, $post);
    }

    public function show($id)
    {
        $post = $this->pageService->show($id);
        return view('backoffice.pages.pages.edit', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->pageService->show($id);
        return view('backoffice.pages.pages.edit', compact('post'));
    }

    public function update(UpdatePageRequestInterface $request, $id)
    {
        $post = $this->pageService->update($id, $request->validated());
        return $this->responses(UpdatePageResponseContract::class, $post);
    }

    public function destroy($id)
    {
        $this->pageService->delete($id);
        return redirect()->route('bo.web.pages.pages.index');
    }
    
}
