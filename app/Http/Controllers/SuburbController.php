<?php

namespace App\Http\Controllers;


use App\Services\SuburbService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function getAllSuburbs()
    {
        $neighborhoods = $this->neighborhoodService->getSuburbs();

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
        try {
            $neighborhood = $this->neighborhoodService->getSuburb($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
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
}