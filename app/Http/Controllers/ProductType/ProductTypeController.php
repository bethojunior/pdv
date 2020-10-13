<?php

namespace App\Http\Controllers\ProductType;

use App\Http\Controllers\Controller;
use App\productType;
use App\Services\ProductType\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{

    private $service;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->service = $productTypeService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types = $this->service
            ->getAll();
        return view('products.type')
            ->with(['types' => $types]);
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
            return redirect()->route('typeProduct.index')
                ->with('error', 'Erro ao inserir tipo de produto '.$exception->getMessage());
        }
        return redirect()->route('typeProduct.index')
            ->with('success', 'Inserido com sucesso');
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
     * @param  \App\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(productType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(productType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(productType $productType)
    {
        //
    }
}
