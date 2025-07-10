<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListAttributeValueResponseContract;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;

class AttributeValueController extends BaseApiController
{
    public function __construct(protected AttributeValueService $attributeValueService)
    {
    }

    public function index(Request $request)
    {
        $attribute_values = $this->attributeValueService->searchByAdmin($request->all());
        
        return $this->responses(ListAttributeValueResponseContract::class, $attribute_values);
    }
}
