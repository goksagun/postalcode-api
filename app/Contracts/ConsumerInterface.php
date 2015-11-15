<?php

namespace App\Contracts;


use App\Consumer;
use App\User;

interface ConsumerInterface
{
    /**
     * Create a new consumer.
     *
     * @param User $user
     * @param array $data
     * @return Consumer
     */
    public function insert(User $user, array $data);

    /**
     * Create new API key and secret.
     *
     * @param Consumer $consumer
     * @return Consumer
     */
    public function createApiKeyAndApiSecret(Consumer $consumer);

    /**
     * Verify API key and secret.
     *
     * @param $apiKey
     * @param $apiSecret
     * @return mixed
     */
    public function verifyApiKeyAndApiSecret($apiKey, $apiSecret);
}