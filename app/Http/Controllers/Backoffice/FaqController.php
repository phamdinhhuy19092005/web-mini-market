<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreFaqResponseContract;
use App\Contracts\Responses\Backoffice\UpdateFaqResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreFaqRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateFaqRequestInterface;

use App\Models\FaqTopic;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    protected $faqService;

    public function __construct(faqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.faqs.index');
    }

    public function create()
    {
        $faqTopics = FaqTopic::all();

        return view('backoffice.pages.faqs.create', compact('faqTopics'));
    }

    public function store(StoreFaqRequestInterface $request)
    {
        $faq = $this->faqService->create($request->validated());

        return $this->responses(StoreFaqResponseContract::class, $faq);
    }

    public function show($id)
    {
        $faqTopics = FaqTopic::all();
        $faq = $this->faqService->show($id);

        return view('backoffice.pages.faqs.edit', compact('faqTopics','faq'));
    }

    public function edit($id)
    {
        $faqTopics = FaqTopic::all();
        $faq = $this->faqService->show($id);

        return view('backoffice.pages.faqs.edit', compact('faqTopics','faq'));
    }

    public function update(UpdateFaqRequestInterface $request, $id)
    {
        $faq = $this->faqService->update($id, $request->validated());

        return $this->responses(UpdateFaqResponseContract::class, $faq);
    }

    public function destroy($id)
    {
        $this->faqService->delete($id);

        return redirect()->route('bo.web.faqs.index');
    }

}
