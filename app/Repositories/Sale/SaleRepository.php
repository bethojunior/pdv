<?php


namespace App\Repositories\Sale;


use App\Constants\SaleConstants;
use App\Contracts\Repository\AbstractRepository;
use App\Models\Sale\Sale;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @param $id
     * @param array $columns
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $model = $this->getModel();
        return $model::select($columns)->where('table', $id)->first();
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return Builder|Model|object|null
     */
    public function findOpen($id, $columns = ['*'])
    {
        $model = $this->getModel();
        return $model::select($columns)->where('table', $id)
            ->where('status','=',SaleConstants::OPEN)
            ->first();
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return Builder|Model|object|null
     */
    public function findTable($id, $columns = ['*'])
    {
        $model = $this->getModel();
        return $model::select($columns)->where('id', $id)->first();
    }
}
