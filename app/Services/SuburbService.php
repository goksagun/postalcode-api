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
    protected $suburbRepository;

    /**
     * SuburbService constructor.
     *
     * @param SuburbRepository $suburbRepository
     */
    function __construct(SuburbRepository $suburbRepository)
    {
        $this->suburbRepository = $suburbRepository;
    }

    /**
     * @param int $perPage
     * @return array
     */
    public function getSuburbs($perPage = 15)
    {
        $suburbs = $this->suburbRepository->paginate($perPage);

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
        $suburb = $this->suburbRepository->findOne($id);

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

        return $this->suburbRepository->create($data);
    }
}
