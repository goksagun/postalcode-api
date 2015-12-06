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
    protected $neighborhoodRepository;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepository $neighborhoodRepository
     */
    function __construct(NeighborhoodRepository $neighborhoodRepository)
    {
        $this->neighborhoodRepository = $neighborhoodRepository;
    }

    /**
     * @param int $perPage
     * @return array
     */
    public function getNeighborhoods($perPage = 15)
    {
        $neighborhoods = $this->neighborhoodRepository->paginate($perPage);

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
        $neighborhood = $this->neighborhoodRepository->findOne($id);

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

        return $this->neighborhoodRepository->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNeighborhoodSuburbs($id)
    {
        $neighborhoodSuburbs = $this->neighborhoodRepository->findNeighborhoodAllSuburbs($id);

        if (!$neighborhoodSuburbs) {
            throw new ModelNotFoundException('The neighborhood suburbs not found');
        }

        return $neighborhoodSuburbs;
    }
}
