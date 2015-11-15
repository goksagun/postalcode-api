<?php

namespace App\Services;


use App\Repositories\NeighborhoodRepository;
use Illuminate\Http\Request;

class NeighborhoodService
{
    protected $repository;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepository $repository
     */
    function __construct(NeighborhoodRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAllNeighborhoods()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $id
     * @return \App\Neighborhood
     */
    public function getNeighborhoodById($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param Request $request
     * @return \App\Neighborhood
     */
    public function createNeighborhood(Request $request)
    {
        $data = [
            'province_id' => $request->get('province_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        return $this->repository->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNeighborhoodAllSuburbs($id)
    {
        return $this->repository->findNeighborhoodAllSuburbs($id);
    }
}
