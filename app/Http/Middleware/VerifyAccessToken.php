<?php

namespace App\Http\Middleware;

use App\Services\ConsumerService;
use App\Services\TokenService;
use Closure;
use Illuminate\Http\Request;

class VerifyAccessToken
{
    /**
     * @var ConsumerService
     */
    protected $consumerService;

    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * VerifyAccessToken constructor.
     *
     * @param TokenService    $tokenService
     * @param ConsumerService $consumerService
     */
    public function __construct(TokenService $tokenService, ConsumerService $consumerService)
    {
        $this->tokenService = $tokenService;
        $this->consumerService = $consumerService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null($request->request->has('x-access-secret'))) {
            return response('Unauthorized.', 401);
        }

//        $consumerKey = $request->header('x-consumer-key');
//        $consumerSecret = $request->header('x-consumer-secret');
//
//        if (!$this->consumerService->checkConsumerApiKeyAndApiSecret($consumerKey, $consumerSecret)) {
//            return response('Consumer not valid.', 401);
//        }

        $accessKey = $request->header('x-access-key');
        $accessSecret = $request->header('x-access-secret');

        if (!$this->tokenService->checkTokenAccessKeyAndAccessSecret($accessKey, $accessSecret)) {
            return response('Token expired or not created.', 401);
        }

//        if (!$this->consumerService->checkApiSecretAndAccessSecret($consumerSecret, $accessSecret)) {
//            return response('Authorization failed.', 401);
//        }

        return $next($request);
    }
}
