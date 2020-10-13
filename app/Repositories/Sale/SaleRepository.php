<?php


namespace App\Repositories\Sale;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Sale\Sale;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setModel(Sale::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll()
    {
        return $this->getModel()
            ::with('user')
            ->with('product')
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $status
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByStatus($status)
    {
        return $this->getModel()
            ::with('user')
            ->with(['products' => function (HasMany $query) {
                $query->with('product');
            }])
            ->where('status','=', $status)
            ->orderByDesc('id')
            ->get();
    }
}
