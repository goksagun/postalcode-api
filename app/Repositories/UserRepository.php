<?php

namespace App\Repositories;


use App\Contracts\UserInterface;
use App\User;

class UserRepository extends AbstractRepository implements UserInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * User constructor.
     *
     * @param $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }

    /**
     * Create a new user it's credentials.
     *
     * @param array $data
     * @return User|mixed
     */
    public function createUser(array $data)
    {
        $user = $this->model->create($data);

        return $user;
    }
}