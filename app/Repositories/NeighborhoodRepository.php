<?php

namespace App\Repositories;


use App\Contracts\NeighborhoodInterface;
use App\Neighborhood;

class NeighborhoodRepository extends AbstractRepository implements NeighborhoodInterface
{
    protected $model;

    /**
     * NeighborhoodRepository constructor.
     *
     * @param $model
     */
    public function __construct(Neighborhood $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findNeighborhoodAllSuburbs($id)
    {
        return $this->model->with('suburbs')->find($id);
    }
}
