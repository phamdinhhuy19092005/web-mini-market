<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreBrandResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBrandResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreBrandRequestInterface;

use App\Http\Requests\Backoffice\Interfaces\UpdateBrandRequestInterface;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.brands.index');
    }

    public function create()
    {
        return view('backoffice.pages.brands.create');
    }

    public function store(StoreBrandRequestInterface $request)
    {
        $brand = $this->brandService->create($request->validated());

        return $this->responses(StoreBrandResponseContract::class, $brand);
    }

    public function show($id)
    {
        $brand = $this->brandService->show($id);

        return view('backoffice.pages.brands.edit', compact('brand'));
    }

    public function edit($id)
    {
        $brand = $this->brandService->show($id);

        return view('backoffice.pages.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequestInterface $request, $id)
    {
        $brand = $this->brandService->update($id, $request->validated());

        return $this->responses(UpdateBrandResponseContract::class, $brand);
    }

    public function destroy($id)
    {
        $this->brandService->delete($id);

        return redirect()->route('bo.web.brands.index');
    }

}
