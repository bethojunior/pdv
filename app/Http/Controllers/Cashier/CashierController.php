<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Services\Cashier\CashierService;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    private $service;

    /**
     * CashierController constructor.
     * @param CashierService $cashierService
     */
    public function __construct(CashierService $cashierService)
    {
        $this->service = $cashierService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $today = $this->service
            ->today();
        return view('cashier.index')->with(['today' => $today]);
    }


}
