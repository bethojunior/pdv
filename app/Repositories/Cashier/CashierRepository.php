<?php


namespace App\Repositories\Cashier;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Cashier\Cashier;

class CashierRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Cashier::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function today()
    {
        return $this->getModel()
            ::with('user')
            ->get();
    }

    /**
     * @return int|mixed
     */
    public function valueToday()
    {
    }
}
