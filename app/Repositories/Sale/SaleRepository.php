<?php


namespace App\Repositories\Sale;


use App\Constants\SaleConstants;
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
            ->with(['products' => function (HasMany $query) {
                $query->with('product');
            }])
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
                $query->with('product')->where('status','=',SaleConstants::OPEN);
            }])
            ->where('status','=', $status)
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllByUser($user)
    {
        return $this->getModel()
            ::with('user')
            ->with(['products' => function (HasMany $query) {
                $query->with('product');
            }])
            ->where('user_id','=', $user)
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $id
     * @return bool|void
     */
    public function updateTable($id)
    {

    }
}
