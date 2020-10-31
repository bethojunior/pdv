<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Services\Cashier\CashierService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    private $service;
    private $userService;

    /**
     * CashierController constructor.
     * @param CashierService $cashierService
     * @param UserService $userService
     */
    public function __construct(CashierService $cashierService , UserService $userService)
    {
        $this->service = $cashierService;
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $today = $this->service
            ->today();
        $valueToday = $this->service
            ->valueToday();
        $users = $this->userService
            ->getAll();
        return view('cashier.index')
            ->with(
                [
                    'today' => $today,
                    'total' => $valueToday,
                    'users' => $users
                ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        try{
            $response = $this->service
                ->filter($request->all());
        }catch (\Exception $exception){
            return redirect()->route('cashier.index')
                ->with('error', 'Erro ao fazer pesquisa, Contate o suporte '.$exception->getMessage());
        }
        return view('cashier.filter')->with(['today' => $response]);
    }


}
