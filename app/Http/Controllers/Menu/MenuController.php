<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Services\ProductType\ProductTypeService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $products;
    private $productType;

    /**
     * MenuController constructor.
     * @param ProductService $productService
     * @param ProductTypeService $productTypeService
     */
    public function __construct(ProductService $productService, ProductTypeService $productTypeService)
    {
        $this->products = $productService;
        $this->productType = $productTypeService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->products
            ->getAll();
        $productsType = $this->productType
            ->getAllWithProducts();
        return view('menu.index')->with(['products' => $products,'productsType' => $productsType]);
    }
}
