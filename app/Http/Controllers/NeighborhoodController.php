<?php

namespace App\Http\Controllers;


use App\Services\NeighborhoodService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class NeighborhoodController
 * @package App\Http\Controllers
 */
class NeighborhoodController extends ApiController
{
    /**
     * @var NeighborhoodService
     */
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
     * @param Request $request
     * @return array
     */
    public function getAllNeighborhoods(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        try {
            $neighborhoods = $this->neighborhoodService->getNeighborhoods($perPage);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

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
        try {
            $neighborhood = $this->neighborhoodService->getNeighborhood($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
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
        try {
            $neighborhoodSuburbs = $this->neighborhoodService->getNeighborhoodSuburbs($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }
        return $this->respond($neighborhoodSuburbs);
    }
}