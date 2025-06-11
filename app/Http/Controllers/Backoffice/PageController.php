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
        $page = $this->pageService->create($request->validated());

        return $this->responses(StorePageResponseContract::class, $page);
    }

    public function show($id)
    {
        $pageDisplayInEnumLabels = PageDisplayInEnum::labels();
        $page = $this->pageService->show($id);

        return view('backoffice.pages.pages.edit', compact('page', 'pageDisplayInEnumLabels'));
    }

    public function edit($id)
    {
        $pageDisplayInEnumLabels = PageDisplayInEnum::labels();
        $page = $this->pageService->show($id);

        return view('backoffice.pages.pages.edit', compact('page', 'pageDisplayInEnumLabels'));
    }

    public function update(UpdatePageRequestInterface $request, $id)
    {
        $page = $this->pageService->update($id, $request->validated());

        return $this->responses(UpdatePageResponseContract::class, $page);
    }

    public function destroy($id)
    {
        $this->pageService->delete($id);
        
        return redirect()->route('bo.web.pages.pages.index');
    }
    
}
