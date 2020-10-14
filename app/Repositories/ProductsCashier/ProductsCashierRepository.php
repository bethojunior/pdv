<?php


namespace App\Repositories\ProductsCashier;


use App\Contracts\Repository\AbstractRepository;
use App\Models\ProductsCashier\ProductsCashier;

class ProductsCashierRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(ProductsCashier::class);
    }
}
