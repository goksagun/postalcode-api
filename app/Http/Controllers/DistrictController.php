<?php

namespace App\Http\Controllers;


use App\Services\DistrictService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends ApiController
{
    protected $districtService;

    /**
     * @param DistrictService $districtService
     */
    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    /**
     * Retrieves all districts.
     *
     * @return array
     */
    public function getAllDistrict()
    {
        $districts = $this->districtService->getAllDistricts();

        return $this->respond($districts);
    }

    /**
     * Retrieves a specific district
     *
     * @param $id
     * @return \App\District
     */
    public function getDistrict($id)
    {
        $district = $this->districtService->getDistrictById($id);

        if (!$district) {
            return $this->respondNotFound('The district not found');
        }

        return $district;
    }

    /**
     * Creates a new district
     *
     * @param Request $request
     * @return \App\District|mixed
     */
    public function postDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationFailed($validator);
        }

        $this->setStatusCode(Response::HTTP_CREATED);

        return $this->respond($this->districtService->createDistrict($request));
    }

    /**
     * Retrieves a specific district all neighborhoods
     *
     * @param $id
     * @return mixed
     */
    public function getDistrictNeighborhoods($id)
    {
        return $this->respond($this->districtService->getDistrictAllNeighborhoods($id));
    }
}