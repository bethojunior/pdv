<?php


namespace App\Repositories\ProductType;


use App\Contracts\Repository\AbstractRepository;
use App\Models\ProductType\ProductType;

class ProductTypeRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(ProductType::class);
    }
}
