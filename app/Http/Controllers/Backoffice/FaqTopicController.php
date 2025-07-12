<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreFaqTopicResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqTopicResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreFaqTopicRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateFaqTopicRequestInterface;

use App\Services\faqTopicService;
use Illuminate\Http\Request;

class FaqTopicController extends BaseController
{
    protected $faqTopicService;

    public function __construct(faqTopicService $faqTopicService)
    {
        $this->faqTopicService = $faqTopicService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.faq-topics.index');
    }

    public function create()
    {
        return view('backoffice.pages.faq-topics.create');
    }

    public function store(StoreFaqTopicRequestInterface $request)
    {
        $post = $this->faqTopicService->create($request->validated());

        return $this->responses(StoreFaqTopicResponseContract::class, $post);
    }

    public function show($id)
    {
        $faqTopic = $this->faqTopicService->show($id);

        return view('backoffice.pages.faq-topics.edit', compact('faqTopic'));
    }

    public function edit($id)
    {
        $post = $this->faqTopicService->show($id);

        return view('backoffice.pages.faq-topics.edit', compact('post'));
    }

    public function update(UpdateFaqTopicRequestInterface $request, $id)
    {
        $post = $this->faqTopicService->update($id, $request->validated());

        return $this->responses(UpdateFaqTopicResponseContract::class, $post);
    }

    public function destroy($id)
    {
        $this->faqTopicService->delete($id);
        
        return redirect()->route('bo.web.faq-topics.index');
    }
    
}
