<?php

namespace App\Services;


use App\Repositories\DistrictRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function getDistricts()
    {
        $districts = $this->repository->paginate();

        if (!$districts) {
            throw new ModelNotFoundException('The districts not found');
        }

        return $districts;
    }

    /**
     * @param $id
     * @return \App\District
     */
    public function getDistrict($id)
    {
        $district = $this->repository->findOne($id);

        if (!$district) {
            throw new ModelNotFoundException('The district not found');
        }

        return $district;
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
    public function existsDistrict($id)
    {
        return $this->repository->exists($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistrictNeighborhoods($id)
    {
        $districtNeighborhoods = $this->repository->findDistrictAllNeighborhoods($id);

        if (!$districtNeighborhoods) {
            throw new ModelNotFoundException('The district neighborhoods not found');
        }

        return $districtNeighborhoods;
    }
}
