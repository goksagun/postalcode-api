<?php

namespace App\Services;


use App\Repositories\DistrictRepository;
use Illuminate\Http\Request;

class DistrictService
{
    protected $repository;

    /**
     * DistrictService constructor.
     *
     * @param DistrictRepository $repository
     */
    function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAllDistricts()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $id
     * @return \App\District
     */
    public function getDistrictById($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param Request $request
     * @return \App\District
     */
    public function createDistrict(Request $request)
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
    public function getDistrictAllNeighborhoods($id)
    {
        return $this->repository->findDistrictAllNeighborhoods($id);
    }
}
