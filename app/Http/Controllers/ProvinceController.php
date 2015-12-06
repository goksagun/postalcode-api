<?php

namespace App\Http\Controllers;


use App\Province;
use App\Services\DistrictService;
use App\Services\ProvinceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProvinceController
 * @package App\Http\Controllers
 */
class ProvinceController extends ApiController
{
    /**
     * @var ProvinceService
     */
    protected $provinceService;

    /**
     * @var DistrictService
     */
    protected $districtService;

    /**
     * @param ProvinceService $provinceService
     * @param DistrictService $districtService
     */
    function __construct(ProvinceService $provinceService, DistrictService $districtService)
    {
        $this->middleware('token');

        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
    }

    /**
     * Retrieves a list of provinces
     *
     * @return array
     */
    public function getAllProvinces()
    {
        try {
            $provinces = $this->provinceService->getProvinces();
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

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
        try {
            $province = $this->provinceService->getProvince($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
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
            return $this->respond($this->provinceService->getProvince($id));
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
        try {
            $provinceDistricts = $this->provinceService->getProvinceDistricts($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

        return $this->respond($provinceDistricts);
    }
}
