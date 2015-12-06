<?php

namespace App\Repositories;


use App\Contracts\UserInterface;
use App\User;

class UserRepository extends AbstractRepository
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
     * Find user by email.
     *
     * @param $email
     * @return User|mixed
     */
    public function findOneByEmail($email)
    {
        $user = $this->model->where('email', '=', $email)->first();

        return $user;
    }
}