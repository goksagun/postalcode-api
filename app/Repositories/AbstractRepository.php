<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->take(1000)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return static
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model->whereId($id)->update($data);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function exists($id)
    {
        return $this->model->whereId($id)->exists();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}