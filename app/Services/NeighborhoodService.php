<?php

namespace App\Services;


use App\Repositories\NeighborhoodRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class NeighborhoodService
 * @package App\Services
 */
class NeighborhoodService
{
    /**
     * @var NeighborhoodRepository
     */
    protected $repository;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepository $repository
     */
    function __construct(NeighborhoodRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getNeighborhoods()
    {
        $neighborhoods = $this->repository->paginate();

        if (!$neighborhoods) {
            throw new ModelNotFoundException('The neighborhoods not found');
        }

        return $neighborhoods;
    }

    /**
     * @param $id
     * @return \App\Neighborhood
     */
    public function getNeighborhood($id)
    {
        $neighborhood = $this->repository->findOne($id);

        if (!$neighborhood) {
            throw new ModelNotFoundException('The neighborhood not found');
        }

        return $neighborhood;
    }

    /**
     * @param Request $request
     * @return \App\Neighborhood
     */
    public function createNeighborhood(Request $request)
    {
        $data = [
            'province_id' => $request->get('province_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        return $this->repository->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNeighborhoodSuburbs($id)
    {
        $neighborhoodSuburbs = $this->repository->findNeighborhoodAllSuburbs($id);

        if (!$neighborhoodSuburbs) {
            throw new ModelNotFoundException('The neighborhood suburbs not found');
        }

        return $neighborhoodSuburbs;
    }
}
