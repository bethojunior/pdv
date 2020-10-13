<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Product;
use App\Services\Product\ProductService;
use App\Services\ProductType\ProductTypeService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductTypeService $productTypeService)
    {
        $productTypes = $productTypeService
            ->getAll();
        $products = $this->service
            ->getAll();
        return view('products.index')
            ->with(['productTypes' => $productTypes,'products' => $products]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexApi()
    {
        $products = $this->service
            ->getAll();
        return ApiResponse::success($products,'Listagem de produtos');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try{
            $insert = $this->service
                ->insert($request->all());
        }catch (\Exception $exception){
            return redirect()->route('products.list')
                ->with('error', 'Erro ao inserir produto '.$exception->getMessage());
        }
        return redirect()->route('products.list')
            ->with('success', 'Produto inserido com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $response = $this->service
                ->delete($id);
        }catch (\Exception $exception){
            return ApiResponse::error('',$exception->getMessage());
        }

        return ApiResponse::success($response,'Produto excluido com sucesso');
    }
}
