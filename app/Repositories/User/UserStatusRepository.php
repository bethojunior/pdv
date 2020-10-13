<?php


namespace App\Repositories\User;


use App\Contracts\Repository\AbstractRepository;
use App\Models\User\UserStatus;

class UserStatusRepository extends AbstractRepository
{
    /**
     * UserStatusRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(UserStatus::class);
    }

}
