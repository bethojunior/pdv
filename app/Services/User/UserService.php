<?php


namespace App\Services\User;


use App\Constants\UserConstant;
use App\Constants\UserStatusConstant;
use App\Http\Responses\ApiResponse;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(){
        return $this->repository->findAll();
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function searchUser(array $request)
    {
        return $this->repository->searchUser($request);
    }

    /**
     * @param User $user
     * @param array $request
     * @return User
     */
    public function update(User $user, array $request)
    {
        if (isset($request['picture'])) {
            $filename =
                \Storage::disk('userprofile')->putFile($user->id, $request['picture']);

            $user->picture = $filename;
        }

        $user->name = $request['name'] ?? $user->name;
        $user->email = $request['email'] ?? $user->email;
        $user->phone = $request['phone'] ?? $user->phone;
        $user->password = isset($request['password']) ?
            bcrypt($request['password']) :
            $user->password;

        $user->save();

        return $user;
    }

    /**
     * @param array $request
     * @return User
     * @throws \Exception
     */
    public function insertUser(array $request)
    {
        try{
            DB::beginTransaction();
            $request['password'] =  bcrypt($request['password']);
            $user = new User($request);
            $user->save();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        return $user;
    }

    /**
     * @param $id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findById($id)
    {
        return $this->repository
            ->findById($id);
    }


    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws \Exception
     */
    public function authenticate(array $data)
    {
        $user = $this->repository->authenticate($data);

        if (!$user)
            throw new \Exception('Usuário não encontrado');

        if (!Hash::check($data['password'] , $user->password))
            throw new \Exception('Senha inválida');

        return $user;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $result = $this->repository->find($id);
            $result->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

        return $result;
    }
}
