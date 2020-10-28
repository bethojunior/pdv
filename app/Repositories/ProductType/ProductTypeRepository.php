<?php


namespace App\Repositories\ProductType;


use App\Contracts\Repository\AbstractRepository;
use App\Models\ProductType\ProductType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTypeRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(ProductType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getWithProducts()
    {
        return $this->getModel()
            ::with('products')
            ->get();
    }
}
