<?php


namespace App\Services\Cashier;


use App\Models\Cashier\Cashier;
use App\Repositories\Cashier\CashierRepository;
use App\Repositories\Sale\SaleRepository;

class CashierService
{
    private $repository;
    private $saleRepository;

    /**
     * CashierService constructor.
     * @param CashierRepository $cashierRepository
     * @param SaleRepository $saleRepository
     */
    public function __construct(CashierRepository $cashierRepository, SaleRepository $saleRepository)
    {
        $this->repository = $cashierRepository;
        $this->saleRepository = $saleRepository;
    }

    /**
     * @return mixed
     */
    public function today()
    {
        return $this->today();
    }

    /**
     * @param array $request
     * @return Cashier
     */
    public function create(array $request)
    {
        $data = [
            'user_id' => $request['user'],
            'value'   => $request['value'],
            'table'   => $request['table']
        ];
        $cashier = new Cashier($data);
        $this->repository->save($cashier);
        return $cashier;

    }



}
