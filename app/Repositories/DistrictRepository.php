<?php

namespace App\Repositories;


use App\Contracts\DistrictInterface;
use App\District;

class DistrictRepository extends AbstractRepository implements DistrictInterface
{
    protected $model;

    /**
     * DistrictRepository constructor.
     *
     * @param $model
     */
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findDistrictAllNeighborhoods($id)
    {
        return $this->model->with('neighborhoods')->find($id);
    }
}
