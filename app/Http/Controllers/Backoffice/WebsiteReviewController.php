<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePostResponseContract;
use App\Contracts\Responses\Backoffice\StoreWebsiteReviewResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostResponseContract;
use App\Contracts\Responses\Backoffice\UpdateWebsiteReviewResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreWebsiteReviewRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateWebReviewRequestInterface;
use App\Models\PostCategory;
use App\Services\WebsiteReviewService;
use Illuminate\Http\Request;

class WebsiteReviewController extends BaseController
{
    protected $webReviewService;

    public function __construct(WebsiteReviewService $webReviewService)
    {
        $this->webReviewService = $webReviewService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.web-reviews.index');
    }

    public function create()
    {
        return view('backoffice.pages.web-reviews.create', compact('postCategories'));
    }

    public function store(StoreWebsiteReviewRequestInterface $request)
    {
        $post = $this->webReviewService->create($request->validated());

        return $this->responses(StoreWebsiteReviewResponseContract::class, $post);
    }

    public function show($id)
    {
        $web_review = $this->webReviewService->show($id);

        return view('backoffice.pages.web-reviews.edit', compact('web_review'));
    }

    public function edit($id)
    {
        $web_review = $this->webReviewService->show($id);

        return view('backoffice.pages.web-reviews.edit', compact('web_review'));
    }

    public function update(UpdateWebReviewRequestInterface $request, $id)
    {
        $web_review = $this->webReviewService->update($id, $request->validated());

        return $this->responses(UpdateWebsiteReviewResponseContract::class, $web_review);
    }

    public function destroy($id)
    {
        $this->webReviewService->delete($id);
        
        return redirect()->route('bo.web.web-reviews.index');
    }
    
}
