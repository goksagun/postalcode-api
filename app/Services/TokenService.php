<?php

namespace app\Services;

use App\Consumer;
use App\Repositories\TokenRepository;
use App\Token;
use Carbon\Carbon;

class TokenService
{
    /**
     * @var TokenRepository
     */
    protected $repository;

    /**
     * TokenService constructor.
     *
     * @param TokenRepository $repository
     */
    public function __construct(TokenRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getToken($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param Consumer $consumer
     *
     * @return mixed
     */
    public function getTokenByConsumer(Consumer $consumer)
    {
        return $consumer->token()->where('expired_at', '>=', Carbon::now())->first();
    }

    /**
     * @param Consumer $consumer
     *
     * @return mixed
     */
    public function getExpiredTokenByConsumer(Consumer $consumer)
    {
        return $consumer->token;
    }

    /**
     * @param $accessKey
     * @param $accessSecret
     *
     * @return bool
     */
    public function checkTokenAccessKeyAndAccessSecret($accessKey, $accessSecret)
    {
        return $this->repository->verifyTokenAccessKeyAndAccessSecret($accessKey, $accessSecret);
    }

    /**
     * @param Consumer $consumer
     * @param array    $data
     *
     * @return Token
     */
    public function createToken(Consumer $consumer, array $data)
    {
        return $this->repository->insert($consumer, $data);
    }

    /**
     * @param $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateToken($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @param $id
     *
     * @return bool|null
     */
    public function deleteToken($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @return array
     */
    public function getTokenAttributes()
    {
        return $this->repository->generateTokenAttributes();
    }
}
