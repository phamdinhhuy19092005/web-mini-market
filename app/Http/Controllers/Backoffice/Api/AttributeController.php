<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListAttributeResponseContract;
use App\Services\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends BaseApiController
{
    public function __construct(protected AttributeService $attributeService)
    {
    }

    public function index(Request $request)
    {
        $attributes = $this->attributeService->searchByAdmin($request->all());
        
        return $this->responses(ListAttributeResponseContract::class, $attributes);
    }
}
