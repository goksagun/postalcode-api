<?php

namespace App\Repositories;


use App\Contracts\DistrictInterface;
use App\District;

/**
 * Class DistrictRepository
 * @package App\Repositories
 */
class DistrictRepository extends AbstractRepository implements DistrictInterface
{
    /**
     * @var District
     */
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

    /**
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findAllDistrictsWithProvinceAndPaginate($perPage = 15)
    {
        return $this->model->with('province')->paginate($perPage);
    }
}
