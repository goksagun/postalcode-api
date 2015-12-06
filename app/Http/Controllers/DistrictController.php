<?php

namespace App\Http\Controllers;


use App\Services\DistrictService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class DistrictController
 * @package App\Http\Controllers
 */
class DistrictController extends ApiController
{
    /**
     * @var DistrictService
     */
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
     * @param Request $request
     * @return array
     */
    public function getAllDistricts(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        try {
            $districts = $this->districtService->getDistricts($perPage);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

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
        try {
            $district = $this->districtService->getDistrict($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
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
        try {
            $districtNeighborhoods = $this->districtService->getDistrictNeighborhoods($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

        return $this->respond($districtNeighborhoods);
    }
}