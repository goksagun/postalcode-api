<?php

namespace App\Http\Controllers;


use App\Services\NeighborhoodService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class NeighborhoodController extends ApiController
{
    protected $neighborhoodService;

    /**
     * @param NeighborhoodService $neighborhoodService
     */
    public function __construct(NeighborhoodService $neighborhoodService)
    {
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * Retrieves all neighborhoods.
     *
     * @return array
     */
    public function getAllNeighborhood()
    {
        $neighborhoods = $this->neighborhoodService->getAllNeighborhoods();

        return $this->respond($neighborhoods);
    }

    /**
     * Retrieves a specific neighborhood
     *
     * @param $id
     * @return \App\Neighborhood
     */
    public function getNeighborhood($id)
    {
        $neighborhood = $this->neighborhoodService->getNeighborhoodById($id);

        if (!$neighborhood) {
            return $this->respondNotFound('The neighborhood not found');
        }

        return $neighborhood;
    }

    /**
     * Creates a new neighborhood
     *
     * @param Request $request
     * @return \App\Neighborhood|mixed
     */
    public function postNeighborhood(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_id' => 'required|exists:districts,id',
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationFailed($validator);
        }

        $this->setStatusCode(Response::HTTP_CREATED);

        return $this->respond($this->neighborhoodService->createNeighborhood($request));
    }

    /**
     * Retrieves a specific neighborhood all neighborhoods
     *
     * @param $id
     * @return mixed
     */
    public function getNeighborhoodSuburbs($id)
    {
        return $this->respond($this->neighborhoodService->getNeighborhoodAllSuburbs($id));
    }
}