<?php

namespace app\Repositories;

use App\Consumer;
use App\Contracts\ConsumerInterface;
use App\User;

class ConsumerRepository extends AbstractRepository implements ConsumerInterface
{
    /**
     * @var Consumer
     */
    protected $model;

    /**
     * ConsumerRepository constructor.
     *
     * @param Consumer $model
     */
    public function __construct(Consumer $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }

    /**
     * @return Consumer
     */
    public function consumer()
    {
        return $this->model;
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return Consumer
     */
    public function insert(User $user, array $data)
    {
        $consumer = new Consumer($data);

        $user->consumers()->save($consumer);

        return $consumer;
    }

    /**
     * Create new API key and secret.
     *
     * @param Consumer $consumer
     *
     * @return Consumer
     */
    public function createApiKeyAndApiSecret(Consumer $consumer)
    {
        $consumer->api_key = str_random(25);
        $consumer->api_secret = str_random(50);

        $consumer->save();

        return $consumer;
    }

    /**
     * Verify API key and secret.
     *
     * @param $apiKey
     * @param $apiSecret
     *
     * @return bool
     */
    public function verifyApiKeyAndApiSecret($apiKey, $apiSecret)
    {
        return Consumer::where('api_key', $apiKey)
            ->where('api_secret', $apiSecret)
            ->exists();
    }
}
