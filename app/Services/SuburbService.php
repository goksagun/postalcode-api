<?php

namespace App\Services;


use App\Repositories\SuburbRepository;
use Illuminate\Http\Request;

class SuburbService
{
    protected $repository;

    /**
     * SuburbService constructor.
     *
     * @param SuburbRepository $repository
     */
    function __construct(SuburbRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAllSuburbs()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $id
     * @return \App\Suburb
     */
    public function getSuburbById($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param Request $request
     * @return \App\Suburb
     */
    public function createSuburb(Request $request)
    {
        $data = [
            'neighborhood_id' => $request->get('neighborhood_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        return $this->repository->create($data);
    }
}
