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
     * @param $accessKey
     * @param $accessSecret
     *
     * @return bool
     */
    public function verifyTokenAccessKeyAndAccessSecret($accessKey, $accessSecret)
    {
        return Token::where('access_key', $accessKey)
            ->where('access_secret', $accessSecret)
            ->where('expired_at', '>=', date('Y-m-d H:i:s'))
            ->exists();
    }

    /**
     * @return mixed
     */
    public function generateTokenAttributes()
    {
        return $this->model->generateTokens();
    }
}
