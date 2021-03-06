<?php

namespace App\Repositories;


use App\Contracts\ProvinceInterface;
use App\Province;

class ProvinceRepository extends AbstractRepository implements ProvinceInterface
{
    protected $model;

    /**
     * ProvinceRepository constructor.
     *
     * @param Province $model
     */
    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findProvinceAllDistricts($id)
    {
        return $this->model->with('districts')->find($id);
    }
}
