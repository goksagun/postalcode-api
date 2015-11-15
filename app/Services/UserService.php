<?php

namespace App\Services;


use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Auth\Guard;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * AuthService constructor.
     *
     * @param UserRepository $repository
     * @param Guard $auth
     */
    public function __construct(UserRepository $repository, Guard $auth)
    {
        $this->repository = $repository;
        $this->auth = $auth;
    }

    /**
     * @param array $data
     * @return User|mixed
     */
    public function createUser(array $data)
    {
        return $this->repository->createUser($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @return mixed
     */
    public function getAuthUser()
    {
        return $this->getUser($this->auth->user()->getAuthIdentifier());
    }
}