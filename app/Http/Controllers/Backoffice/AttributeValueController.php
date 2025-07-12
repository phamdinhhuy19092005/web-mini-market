<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAttributeValueResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAttributeValueResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreAttributeValueRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAttributeValueRequestInterface;

use App\Models\Attribute;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;

class AttributeValueController extends BaseController
{
    protected $attributeValueService;

    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.attribute-values.index');
    }

    public function create()
    {
        $Attributes = Attribute::all();
        return view('backoffice.pages.attribute-values.create', compact('Attributes'));
    }

    public function store(StoreAttributeValueRequestInterface $request)
    {
        $attribute_value = $this->attributeValueService->create($request->validated());
        
        return $this->responses(StoreAttributeValueResponseContract::class, $attribute_value);
    }

    public function show($id)
    {
        $attribute_value = $this->attributeValueService->show($id);

        return view('backoffice.pages.attribute-values.edit', compact('attribute_value'));
    }

    public function edit($id)
    {
        $attribute_value = $this->attributeValueService->show($id);
        return view('backoffice.pages.attribute-values.edit', compact('attribute_value'));
    }

    public function update(UpdateAttributeValueRequestInterface $request, $id)
    {
        $attribute_value = $this->attributeValueService->update($id, $request->validated());

        return $this->responses(UpdateAttributeValueResponseContract::class, $attribute_value);
    }

    public function destroy($id)
    {
        $this->attributeValueService->delete($id);

        return redirect()->route('bo.web.attribute-values.index');
    }
}
