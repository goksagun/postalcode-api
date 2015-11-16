<?php

namespace App\Http\Controllers;


use App\Province;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends ApiController
{
    protected $provinceService;

    /**
     * @param ProvinceService $provinceService
     */
    function __construct(ProvinceService $provinceService)
    {
        $this->middleware('token');

        $this->provinceService = $provinceService;
    }

    /**
     * Retrieves a list of provinces
     *
     * @return array
     */
    public function getAllProvinces()
    {
        $provinces = $this->provinceService->getAllProvinces();

        return $this->respond($provinces);
    }

    /**
     * Retrieves a specific province
     *
     * @param  int $id
     * @return Province
     */
    public function getProvince($id)
    {
        $province = $this->provinceService->getProvinceById($id);

        if (!$province) {
            return $this->respondNotFound('The province not found');
        }

        return $this->respond($province);
    }

    /**
     * Creates a new province
     *
     * @param  Request $request
     * @return Province
     */
    public function postProvince(Request $request)
    {
        return [
            $request->header('x-access-token')
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationFailed($validator);
        }

        return $this->respondCreated($this->provinceService->createProvince($request));
    }

    /**
     * Updates a specific province
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function putProvince(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationFailed($validator);
        }

        if (!$this->provinceService->existsProvince($id)) {
            return $this->respondNotFound('The province not found');
        }

        if ($this->provinceService->updateProvince($request, $id)) {
            return $this->respond($this->provinceService->getProvinceById($id));
        }

        return $this->respondNotFound('The province update failed', 'You have entered invalid parameter of id or same province parameter(s)');
    }

    /**
     * Deletes a specific province
     *
     * @param $id
     * @return mixed
     */
    public function deleteProvince($id)
    {
        if (!$this->provinceService->existsProvince($id)) {
            return $this->respondNotFound('The province not found');
        }

        if ($this->provinceService->deleteProvince($id)) {
            return $this->responpodDeleted();
        }
    }

    /**
     * Retrieves a specific province all districts
     *
     * @param $id
     * @return mixed
     */
    public function getProvinceDistricts($id)
    {
        if (!$this->provinceService->existsProvince($id)) {
            return $this->respondNotFound('The province not found');
        }

        $provinceDistricts = $this->provinceService->getProvinceAllDistricts($id);

        return $this->respond($provinceDistricts);
    }
}
