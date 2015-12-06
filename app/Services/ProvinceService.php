<?php

namespace App\Services;


use App\Repositories\DistrictRepository;
use App\Repositories\ProvinceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class ProvinceService
 * @package App\Services
 */
class ProvinceService
{
    /**
     * @var ProvinceRepository
     */
    protected $provinceRepository;

    /**
     * @param ProvinceRepository $provinceRepository
     */
    function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * @param int $perPage
     * @return array
     */
    public function getProvinces($perPage = 15)
    {
        $provinces = $this->provinceRepository->paginate($perPage);

        if (!$provinces) {
            throw new ModelNotFoundException('Provinces not found');
        }

        return $provinces;
    }

    /**
     * @param $id
     * @return \App\Province
     */
    public function getProvince($id)
    {
        $province = $this->provinceRepository->findOne($id);

        if (!$province) {
            throw new ModelNotFoundException('The province not found');
        }

        return $province;
    }

    /**
     * @param Request $request
     * @return \App\Province
     */
    public function createProvince(Request $request)
    {
        $data = [
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        return $this->provinceRepository->create($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateProvince(Request $request, $id)
    {
        $data = [
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        return $this->provinceRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function deleteProvince($id)
    {
        return $this->provinceRepository->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function existsProvince($id)
    {
        return $this->provinceRepository->exists($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProvinceDistricts($id)
    {
        $provinceDistricts = $this->provinceRepository->findProvinceAllDistricts($id);

        if (!$provinceDistricts) {
            throw new ModelNotFoundException('Province districts not found');
        }

        return $provinceDistricts;
    }
}
