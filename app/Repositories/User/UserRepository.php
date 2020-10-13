<?php

namespace App\Repositories\User;

use App\Contracts\Repository\AbstractRepository;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends AbstractRepository
{

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(User::class);
    }


    public function findAll(){
        return $this->getModel()
            ::with('userStatus')
            ->with('userType')
            ->get();
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchUser($data)
    {
        $users = $this->getModel()
            ::join('user_status', 'users.user_status_id', '=', 'user_status.id')
            ->leftJoin('enterprises', 'users.enterprises_id', '=', 'enterprises.id')
            ->select(
                'users.id AS user_id',
                'users.name',
                'users.email',
                'users.created_at',
                'user_status.name AS status',
                'enterprises.name as enterprise'
            )

            ->when(isset($data['name']), function (Builder $query) use ($data) {
                $query->where('users.name', 'LIKE', "%{$data['name']}%");
            })

            ->when(isset($data['enterprise_id']), function (Builder $query) use ($data) {
                $query->where('users.enterprises_id', $data['enterprise_id']);
            })

            ->when(isset($data['user_status_id']), function (Builder $query) use ($data) {
                $query->where('users.user_status_id', $data['user_status_id']);
            })
            ->paginate(7);
        return $users;
    }


    /**
     * @param $id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findById($id)
    {
        $user = $this->getModel()
            ::join('user_status', 'users.user_status_id', '=', 'user_status.id')
            ->leftJoin('enterprises', 'users.enterprises_id', '=', 'enterprises.id')
            ->select(
                'users.id AS user_id',
                'users.name',
                'users.email',
                'users.created_at',
                'users.picture',
                'users.phone',
                'user_status.name AS status',
                'enterprises.name as enterprise'
            )

            ->when(isset($id), function (Builder $query) use($id){
                $query->where('users.id','=',$id);
            })

            ->get();
        return $user;
    }

    /**
     * @param $data
     * @return Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function authenticate($data)
    {
        return $this->getModel()
            ::join('user_status', 'users.user_status_id', '=', 'user_status.id')
            ->with('userStatus')
            ->with('userType')
            ->where('users.email','=',$data['email'])
            ->first();
    }

    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findAllWithoutPaginate(){
        return $this->getModel()
            ::join('user_status','users.user_status_id','=','user_status.id')
            ->leftJoin('enterprises','users.enterprises_id','=','enterprises.id')
            ->select(
                'users.name','users.email','users.created_at',
                'user_status.name as status',
                'enterprises.name as enterprise'
            )
            ->orderByDesc('users.id')
            ->get();
    }

}
