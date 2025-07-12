<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListProductResponseContract;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $products = $this->productService->searchByAdmin($request->all());
        
        return $this->responses(ListProductResponseContract::class, $products);
    }
}
