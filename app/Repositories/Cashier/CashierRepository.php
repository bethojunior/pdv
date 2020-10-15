<?php


namespace App\Repositories\Cashier;


use App\Contracts\Repository\AbstractRepository;
use App\Models\Cashier\Cashier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
            ->whereDate('created_at','=',Carbon::now())
            ->get();
    }

    /**
     * @return int|mixed
     */
    public function valueToday()
    {

    }

    /**
     * @param $data
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function filter($data)
    {
        return $this->getModel()
            ::with('user')

            ->when(isset($data['start']), function (Builder $query) use($data){
                $query->whereBetween('created_at',array($data['start'],$data['end']));
            })

            ->when(isset($data['user']), function (Builder $query) use($data){
                $query->where('user_id','=',$data['user']);
            })

            ->get();
    }

}
