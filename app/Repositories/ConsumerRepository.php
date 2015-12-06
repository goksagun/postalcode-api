<?php

namespace App\Repositories;

use App\Consumer;
use App\Contracts\ConsumerInterface;
use App\Token;
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

    /**
     * @param $apiSecret
     * @param $accessSecret
     *
     * @return bool
     */
    public function verifyApiSecretAndAccessSecret($apiSecret, $accessSecret)
    {
        $consumer = Consumer::where('api_secret', $apiSecret)->first();

        $token = Token::where('access_secret', $accessSecret)->first();

        if ($consumer && $token) {
            return $consumer->token->access_secret === $token->access_secret;
        }

        return false;
    }

    /**
     * @param $consumerKey
     * @param $consumerSecret
     *
     * @return null|Token
     */
    public function getConsumerToken($consumerKey, $consumerSecret)
    {
        return Consumer::where('api_key', $consumerKey)
            ->where('api_secret', $consumerSecret)
            ->first()->token;
    }
}
