<?php

namespace app\Repositories;

use App\Consumer;
use App\Token;

class TokenRepository extends AbstractRepository
{
    /**
     * @var Token
     */
    protected $model;

    /**
     * TokenRepository constructor.
     *
     * @param Token $model
     */
    public function __construct(Token $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }

    /**
     * @param Consumer $consumer
     * @param $data
     *
     * @return Token
     */
    public function insert(Consumer $consumer, array $data)
    {
        $token = new Token($data);

        $consumer->token()->save($token);

        return $token;
    }

    /**
     * @return mixed
     */
    public function generateTokenAttributes()
    {
        return $this->model->generateTokens();
    }
}
