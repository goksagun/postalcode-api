<?php

namespace App\Repositories;


use App\Contracts\SuburbInterface;
use App\Suburb;

/**
 * Class SuburbRepository
 * @package App\Repositories
 */
class SuburbRepository extends AbstractRepository implements SuburbInterface
{
    /**
     * @var Suburb
     */
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
