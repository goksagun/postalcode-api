<?php

namespace App\Services;


use App\Repositories\ProvinceRepository;
use Illuminate\Http\Request;

class ProvinceService
{
    protected $repository;

    /**
     * @param ProvinceRepository $repository
     */
    function __construct(ProvinceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAllProvinces()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $id
     * @return \App\Province
     */
    public function getProvinceById($id)
    {
        return $this->repository->findOne($id);
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

        return $this->repository->create($data);
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

        return $this->repository->update($id, $data);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function deleteProvince($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function existsProvince($id)
    {
        return $this->repository->exists($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProvinceAllDistricts($id)
    {
        return $this->repository->findProvinceAllDistricts($id);
    }
}
