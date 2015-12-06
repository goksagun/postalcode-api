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
        return $this->repository->create($data);
    }

    /**
     * @param $id
     * @return User|mixed
     */
    public function getUser($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param $email
     * @return User|mixed
     */
    public function getUserByEmail($email)
    {
        return $this->repository->findOneByEmail($email);
    }

    /**
     * @return User|mixed
     */
    public function getAuthUser()
    {
        return $this->getUser($this->auth->user()->getAuthIdentifier());
    }
}