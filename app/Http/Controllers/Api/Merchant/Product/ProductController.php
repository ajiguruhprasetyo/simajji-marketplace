<?php

namespace App\Http\Controllers\Api\Merchant\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index(){
        return $this->productService->getProduct();
    }

    public function store(Request $request){
        return $this->productService->storeData($request);
    }

    public function update(Request $request, $id){
        return $this->productService->updateData($request,$id);
    }

    public function show($id){
        return $this->productService->showData($id);
    }

    public function active($id){
        return $this->productService->active($id);
    }
    public function inactive($id){
        return $this->productService->inactive($id);
    }


}
