<?php

namespace App\Contracts;


use App\User;

interface UserInterface
{
    /**
     * Create a new user it's credentials.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data);
}