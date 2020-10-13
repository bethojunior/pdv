<?php


namespace App\Repositories\Product;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Product\Product;

class ProductRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getAll()
    {
        return $this->getModel()
            ::with('type')
            ->get();
    }
}
