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

}
