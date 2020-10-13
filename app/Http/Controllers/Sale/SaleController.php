<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Services\Product\ProductService;
use App\Services\Sale\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    private $service;

    /**
     * SaleController constructor.
     * @param SaleService $saleService
     */
    public function __construct(SaleService $saleService)
    {
        $this->service = $saleService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductService $productService)
    {
        $salesOpen = $this->service
            ->getAllByStatus();
        $products = $productService->getAll();
        return view('sale.init')
            ->with(['sales' => $salesOpen,'products' => $products]);
    }

    /**
     *
     */
    public function create(Request $request)
    {
        try{
            $insert = $this->service
                ->insert($request->all());
        }catch (\Exception $exception){
            return redirect()->route('sales.index')
                ->with('error', 'Erro ao inserir produto '.$exception->getMessage());
        }
        return redirect()->route('sales.index')
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
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(sale $sale)
    {
        //
    }
}
