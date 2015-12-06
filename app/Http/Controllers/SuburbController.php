<?php

namespace App\Http\Controllers;


use App\Services\SuburbService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class SuburbController
 * @package App\Http\Controllers
 */
class SuburbController extends ApiController
{
    /**
     * @var SuburbService
     */
    protected $suburbService;

    /**
     * @param SuburbService $suburbService
     */
    public function __construct(SuburbService $suburbService)
    {
        $this->suburbService = $suburbService;
    }

    /**
     * Retrieves all suburbs.
     *
     * @param Request $request
     * @return array
     */
    public function getAllSuburbs(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        try {
            $suburbs = $this->suburbService->getSuburbs($perPage);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

        return $this->respond($suburbs);
    }

    /**
     * Retrieves a specific suburb
     *
     * @param $id
     * @return \App\Suburb
     */
    public function getSuburb($id)
    {
        try {
            $suburb = $this->suburbService->getSuburb($id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound($e->getMessage());
        }

        return $suburb;
    }

    /**
     * Creates a new suburb
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

        return $this->respond($this->suburbService->createSuburb($request));
    }
}