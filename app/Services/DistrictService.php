<?php

namespace App\Services;


use App\Repositories\DistrictRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class DistrictService
 * @package App\Services
 */
class DistrictService
{
    /**
     * @var DistrictRepository
     */
    protected $districtRepository;

    /**
     * DistrictService constructor.
     *
     * @param DistrictRepository $districtRepository
     */
    function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    /**
     * @param int $perPage
     * @return array
     */
    public function getDistricts($perPage = 15)
    {
        $districts = $this->districtRepository->paginate($perPage);

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
        $district = $this->districtRepository->findOne($id);

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

        return $this->districtRepository->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function existsDistrict($id)
    {
        return $this->districtRepository->exists($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistrictNeighborhoods($id)
    {
        $districtNeighborhoods = $this->districtRepository->findDistrictAllNeighborhoods($id);

        if (!$districtNeighborhoods) {
            throw new ModelNotFoundException('The district neighborhoods not found');
        }

        return $districtNeighborhoods;
    }
}
