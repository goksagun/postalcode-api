<?php

namespace App\Repositories;


use App\Contracts\SuburbInterface;
use App\Suburb;

class SuburbRepository extends AbstractRepository implements SuburbInterface
{
    protected $model;

    /**
     * SuburbRepository constructor.
     *
     * @param $model
     */
    public function __construct(Suburb $model)
    {
        $this->model = $model;
    }
}
