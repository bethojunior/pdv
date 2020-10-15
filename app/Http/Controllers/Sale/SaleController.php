<?php

namespace App\Http\Controllers\Sale;

use App\Constants\SaleConstants;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
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
            ->getAllByStatus(SaleConstants::OPEN);
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        try{
            $insert = $this->service
                ->updateStatus($request->all());
        }catch (\Exception $exception){
            return ApiResponse::error('Erro ao alterar status',$exception->getMessage());
        }
        return ApiResponse::success($insert,'Mesa fechada com sucesso');
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
