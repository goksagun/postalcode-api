<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;

class ApiController extends Controller
{
    protected $statusCode = Response::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        $statusCode = $this->getStatusCode();

        return response()->json($data, $statusCode, $headers);
    }

    /**
     * @param string $message
     * @param string $description
     * @return mixed
     */
    public function respondNotFound($message = 'The item not found', $description = 'You have entered invalid parameter of id')
    {
        $this->setStatusCode(Response::HTTP_NOT_FOUND);

        return $this->respond([
            'code' => 0,
            'message' => $message,
            'description' => $description
        ]);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function respondCreated($model)
    {
        $this->setStatusCode(Response::HTTP_CREATED);

        return $this->respond($model);
    }

    /**
     * @param string $message
     * @param string $description
     * @return mixed
     */
    public function respondDeleted($message = 'There is no content', $description = 'The item deleted successfully')
    {
        $this->setStatusCode(Response::HTTP_MOVED_PERMANENTLY);

        return $this->respond([
            'code' => 0,
            'message' => $message,
            'description' => $description,
        ]);
    }

    /**
     * @param $validator
     * @return mixed
     */
    public function respondValidationFailed($validator)
    {
        $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this->respond([
            'code' => 0,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ]);
    }
}
