<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $products;

    /**
     * MenuController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->products = $productService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->products
            ->getAll();
        return view('menu.index')->with(['products' => $products]);
    }
}
