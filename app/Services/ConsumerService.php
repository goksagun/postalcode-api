<?php

namespace App\Services;

use App\Consumer;
use App\Repositories\ConsumerRepository;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsumerService
{
    /**
     * @var ConsumerRepository
     */
    protected $repository;

    /**
     * ConsumerService constructor.
     *
     * @param ConsumerRepository $repository
     */
    public function __construct(ConsumerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Consumer
     */
    public function getNew()
    {
        return $this->repository->consumer();
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return mixed
     */
    public function createConsumer(User $user, array $data)
    {
        return $this->repository->insert($user, $data);
    }

    /**
     * @param User $user
     *
     * @return HasMany
     */
    public function getConsumers(User $user)
    {
        return $user->consumers;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getConsumer($id)
    {
        return $this->repository->findOne($id);
    }

    /**
     * @param User $user
     *
     * @return HasMany
     */
    public function getConsumersByUser(User $user)
    {
        return $user->consumers();
    }

    /**
     * @param $id
     * @param array $data
     *
     * @return Consumer
     */
    public function updateConsumer($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @param $apiKey
     * @param $apiSecret
     *
     * @return bool
     */
    public function checkConsumerApiKeyAndApiSecret($apiKey, $apiSecret)
    {
        return $this->repository->verifyApiKeyAndApiSecret($apiKey, $apiSecret);
    }

    /**
     * @param $apiSecret
     * @param $accessSecret
     *
     * @return bool
     */
    public function checkApiSecretAndAccessSecret($apiSecret, $accessSecret)
    {
        return $this->repository->verifyApiSecretAndAccessSecret($apiSecret, $accessSecret);
    }
}
