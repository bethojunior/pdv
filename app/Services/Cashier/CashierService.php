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
        return $this->repository->today();
    }

    /**
     * @return int|mixed
     */
    public function valueToday()
    {
        return $this->repository->valueToday();
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

    /**
     * @param $data
     * @return mixed
     */
    public function filter($data)
    {
        $data['start'] = \Carbon\Carbon::parse($data['start'])->format('Y/m/d');
        $data['end'] = \Carbon\Carbon::parse($data['end'])->format('Y/m/d');
        return $this->repository->filter($data);
    }

}
