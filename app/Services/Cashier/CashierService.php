<?php


namespace App\Services\Cashier;


use App\Models\Cashier\Cashier;
use App\Models\ProductsCashier\ProductsCashier;
use App\Repositories\Cashier\CashierRepository;
use App\Repositories\ProductsCashier\ProductsCashierRepository;
use App\Repositories\Sale\SaleRepository;

class CashierService
{
    private $repository;
    private $saleRepository;
    private $productsCashierRepository;

    /**
     * CashierService constructor.
     * @param CashierRepository $cashierRepository
     * @param SaleRepository $saleRepository
     * @param ProductsCashierRepository $productsCashierRepository
     */
    public function __construct(CashierRepository $cashierRepository, SaleRepository $saleRepository, ProductsCashierRepository $productsCashierRepository)
    {
        $this->repository = $cashierRepository;
        $this->saleRepository = $saleRepository;
        $this->productsCashierRepository = $productsCashierRepository;
    }

    /**
     * @return mixed
     */
    public function today()
    {
        return $this->repository->today();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function valueToday()
    {
        return $this->repository->valueToday();
    }

    /**
     * @param array $request
     * @return Cashier
     */
    public function create(array $request , $table)
    {
        $sale = $this->saleRepository->findOpen($table->table);

        $data = json_decode($request['products']);
        foreach ($data as $products){
            foreach ($products->product as $product){
                $app = new ProductsCashier([
                    'product_id' => $product->id,
                    'sale_id'    => $request['table']
                ]);
                $this->productsCashierRepository->save($app);
            }
        }
        $data = [
            'user_id'  => $request['user'],
            'value'    => $request['value'],
            'table'    => $request['table'],
            'sales_id' => $sale->id
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
