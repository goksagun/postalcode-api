<?php

namespace App\Http\Controllers;


use App\Services\SuburbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuburbController extends ApiController
{
    protected $neighborhoodService;

    /**
     * @param SuburbService $neighborhoodService
     */
    public function __construct(SuburbService $neighborhoodService)
    {
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * Retrieves all neighborhoods.
     *
     * @return array
     */
    public function getAllSuburb()
    {
        $neighborhoods = $this->neighborhoodService->getAllSuburbs();

        return $this->respond($neighborhoods);
    }

    /**
     * Retrieves a specific neighborhood
     *
     * @param $id
     * @return \App\Suburb
     */
    public function getSuburb($id)
    {
        $neighborhood = $this->neighborhoodService->getSuburbById($id);

        if (!$neighborhood) {
            return $this->respondNotFound('The neighborhood not found');
        }

        return $neighborhood;
    }

    /**
     * Creates a new neighborhood
     *
     * @param Request $request
     * @return \App\Suburb|mixed
     */
    public function postSuburb(Request $request)
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

        return $this->respond($this->neighborhoodService->createSuburb($request));
    }

    /**
     * Retrieves a specific neighborhood all neighborhoods
     *
     * @param $id
     * @return mixed
     */
    public function getSuburbSuburbs($id)
    {
        return $this->respond($this->neighborhoodService->getSuburbAllSuburbs($id));
    }
}