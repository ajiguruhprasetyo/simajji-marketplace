<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Product\CategoryProductService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategoryService;

    public function __construct(CategoryProductService $productCategoryService){
        $this->productCategoryService = $productCategoryService;
    }

    public function index(){
        return $this->productCategoryService->getProductCategory();
    }

    public function store(Request $request){
        return $this->productCategoryService->storeData($request);
    }

    public function update(Request $request,$id){
        return $this->productCategoryService->updateData($request,$id);
    }

    public function show($id){
        return $this->productCategoryService->showData($id);
    }

    public function active($id){
        return $this->productCategoryService->active($id);
    }
    public function inactive($id){
        return $this->productCategoryService->inactive($id);
    }


}
