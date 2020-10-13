<?php


namespace App\Services\User;


use App\Repositories\User\UserStatusRepository;

class UserStatusService
{
    /**
     * @var UserStatusRepository
     */
    private $repository;

    /**
     * UserStatusService constructor.
     * @param UserStatusRepository $repository
     */
    public function __construct(UserStatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
