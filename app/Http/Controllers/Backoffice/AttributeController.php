<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAttributeResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAttributeResponseContract;
use App\Enum\ProductAttributeTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAttributeRequestInterface;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Services\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends BaseController
{
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.attributes.index');
    }

    public function create()
    {
        $ProductAttributeTypeEnum = ProductAttributeTypeEnum::labels();
        $categories = Category::with('subCategories')->get();
        $categoryGroups = CategoryGroup::all();
        return view('backoffice.pages.attributes.create', compact('ProductAttributeTypeEnum', 'categories', 'categoryGroups'));
    }

    public function store(StoreAttributeRequestInterface $request)
    {
        $attribute = $this->attributeService->create($request->validated());
        
        return $this->responses(StoreAttributeResponseContract::class, $attribute);
    }

    public function show($id)
    {
        $attribute = $this->attributeService->show($id);

        return view('backoffice.pages.attributes.edit', compact('attribute'));
    }

    public function edit($id)
    {
        $ProductAttributeTypeEnum = ProductAttributeTypeEnum::labels();
        $categoryGroups = CategoryGroup::all();
        $Categories = Category::all();
        $attribute = $this->attributeService->show($id);
        return view('backoffice.pages.attributes.edit', compact('attribute', 'ProductAttributeTypeEnum','categoryGroups', 'Categories'));
    }

    public function update(UpdateAttributeRequestInterface $request, $id)
    {
        $attribute = $this->attributeService->update($id, $request->validated());

        return $this->responses(UpdateAttributeResponseContract::class, $attribute);
    }

    public function destroy($id)
    {
        $this->attributeService->delete($id);

        return redirect()->route('bo.web.attributes.index');
    }
}
