<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreProductResponseContract;
use App\Contracts\Responses\Backoffice\UpdateProductResponseContract;
use App\Enum\ProductTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreProductRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateProductRequestInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.products.index');
    }

    public function create()
    {
        $brands = Brand::all(); 
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $ProductTypeEnumLabels = ProductTypeEnum::labels();
        return view('backoffice.pages.products.create', compact('brands', 'categories', 'sub_categories', 'ProductTypeEnumLabels'));
    }

    public function store(StoreProductRequestInterface $request)
    {
        $product = $this->productService->create($request->validated());

        return $this->responses(StoreProductResponseContract::class, $product);
    }

    public function show($id)
    {
        $brands = Brand::all(); 
        $categories = Category::all();
        $ProductTypeEnumLabels = ProductTypeEnum::labels();
        $product = $this->productService->show($id);
        $product->media = json_decode($product->media, true) ?? [];

        return view('backoffice.pages.products.edit', compact('brands', 'categories', 'ProductTypeEnumLabels' ,'product'));
    }

    public function edit($id)
    {
        $brands = Brand::all(); 
        $categories = Category::all();
        $ProductTypeEnumLabels = ProductTypeEnum::labels();
        $product = $this->productService->show($id);
        $product->media = json_decode($product->media, true) ?? [];

        return view('backoffice.pages.products.edit', compact('brands', 'categories', 'ProductTypeEnumLabels' ,'product'));
    }

    public function update(UpdateProductRequestInterface $request, $id)
    {
        $product = $this->productService->update($id, $request->validated());

        return $this->responses(UpdateProductResponseContract::class, $product);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->route('bo.web.products.index');
    }

}
