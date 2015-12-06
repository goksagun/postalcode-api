<?php

namespace App\Services;


use App\Repositories\SuburbRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class SuburbService
 * @package App\Services
 */
class SuburbService
{
    /**
     * @var SuburbRepository
     */
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
    public function getSuburbs()
    {
        $suburbs = $this->repository->paginate();

        if (!$suburbs) {
            throw new ModelNotFoundException('The suburbs not found');
        }

        return $suburbs;
    }

    /**
     * @param $id
     * @return \App\Suburb
     */
    public function getSuburb($id)
    {
        $suburb = $this->repository->findOne($id);

        if (!$suburb) {
            throw new ModelNotFoundException('The suburb not found');
        }

        return $suburb;
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
