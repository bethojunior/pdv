<?php


namespace App\Repositories\ProductsTable;


use App\Contracts\Repository\AbstractRepository;
use App\Models\ProductsTable\ProductsTable;

class ProductsTableRepository extends AbstractRepository
{

    public function __construct()
    {
        $this->setModel(ProductsTable::class);
    }

    /**
     * @param $table
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByTable($table)
    {
        return $this->getModel()
            ::where('table','=',$table)
            ->get();
    }

    /**
     * @param $table
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function deleteByTable($table)
    {
        return $this->getModel()
            ::where('table','=',$table)
            ->delete();
    }

}
