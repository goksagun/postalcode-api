<?php

namespace App\Http\Controllers;

use App\Consumer;
use App\Services\ConsumerService;
use App\Services\TokenService;
use App\Services\UserService;
use App\Token;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsumerController extends Controller
{
    /**
     * The UserService implementation.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * The ConsumerService implementation.
     *
     * @var ConsumerService
     */
    protected $consumerService;

    /**
     * The TokenService implementation.
     *
     * @var TokenService
     */
    protected $tokenService;

    /**
     * ConsumerController constructor.
     *
     * @param UserService     $userService
     * @param ConsumerService $consumerService
     * @param TokenService    $tokenService
     */
    public function __construct(UserService $userService, ConsumerService $consumerService, TokenService $tokenService)
    {
        $this->middleware('auth');

        $this->userService = $userService;
        $this->consumerService = $consumerService;
        $this->tokenService = $tokenService;
    }

    /**
     * @return View
     */
    public function getConsumers()
    {
        $user = $this->userService->getAuthUser();

        $consumers = $this->consumerService->getConsumers($user);

        return view('consumer.index', compact('consumers'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return View
     */
    public function getConsumer(Request $request, $id)
    {
        $consumer = $this->consumerService->getConsumer($id);

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Application not found!');

            return redirect()->to('consumers');
        }

        return view('consumer.show', compact('consumer'));
    }

    /**
     * @return View
     */
    public function getCreate()
    {
        $consumer = $this->consumerService->getNew();

        return view('consumer.create', compact('consumer'));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $rules = [
            'name' => 'required|max:32|unique:consumers',
            'description' => 'required|min:10|max:200',
            'website' => 'required|url',
        ];

        $this->validate($request, $rules);

        $user = $this->userService->getAuthUser();

        $consumer = $this->consumerService->createConsumer($user, $request->only(['name', 'description', 'website']));

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Something went wrong, please try again later!');

            return redirect()->back();
        }

        return redirect()->to('consumer/'.$consumer->id);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|View
     */
    public function getSettings(Request $request, $id)
    {
        $consumer = $this->consumerService->getConsumer($id);

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Application not found!');

            return redirect()->to('consumers');
        }

        return view('consumer.settings', compact('consumer'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postSettings(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:32|unique:consumers,name,'.$id,
            'description' => 'required|min:10|max:200',
            'website' => 'required|url',
        ];

        $this->validate($request, $rules);

        if (!$this->consumerService->updateConsumer($id, $request->only(['name', 'description', 'website']))) {
            $request->session()->flash('alert.danger', 'Something went wrong, please try again later!');
        }

        $request->session()->flash('alert.success', 'Settings successfully updated!');

        return redirect()->to('consumer/'.$id);
    }

    public function getRecreateKeys(Request $request, $id)
    {
        $consumer = $this->consumerService->getConsumer($id);

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Application not found!');

            return redirect()->to('consumers');
        }

        $data = [
            'api_key' => str_random(Consumer::API_KEY_LENGTH),
            'api_secret' => str_random(Consumer::API_SECRET_LENGTH),
        ];

        $this->consumerService->updateConsumer($id, $data);

        $request->session()->flash('alert.success', 'Api keys successfully regenerated!');

        return redirect()->to('consumer/'.$consumer->id.'/tokens');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|View
     */
    public function getTokens(Request $request, $id)
    {
        $consumer = $this->consumerService->getConsumer($id);

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Application not found!');

            return redirect()->to('consumers');
        }

        $token = $this->tokenService->getTokenByConsumer($consumer);

        return view('consumer.tokens', compact('consumer', 'token'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function getCreateTokens(Request $request, $id)
    {
        $consumer = $this->consumerService->getConsumer($id);

        if (!$consumer) {
            $request->session()->flash('alert.danger', 'Application not found!');

            return redirect()->to('consumers');
        }

        $expiredToken = $this->tokenService->getExpiredTokenByConsumer($consumer);

        if ($expiredToken) {
            $data = $this->tokenService->getTokenAttributes();

            $this->tokenService->updateToken($expiredToken->id, $data);
        } else {
            $token = $this->tokenService->createToken($consumer, []);

            if (!$token) {
                $request->session()->flash('alert.danger', 'Something went wrong, please try again later!');

                return redirect()->back();
            }
        }

        $request->session()->flash('alert.success', 'Access tokens successfully generated!');

        return redirect()->to('consumer/'.$consumer->id.'/tokens');
    }

    /**
     * @param Request $request
     * @param $id
     * @param $tokenId
     *
     * @return RedirectResponse
     */
    public function getRecreateTokens(Request $request, $id, $tokenId)
    {
        $token = $this->tokenService->getToken($tokenId);

        if (!$token) {
            $request->session()->flash('alert.danger', 'Something went wrong, please try again later!');

            return redirect()->back();
        }

        $data = $this->tokenService->getTokenAttributes();

        $this->tokenService->updateToken($tokenId, $data);

        $request->session()->flash('alert.success', 'Access tokens successfully regenerated!');

        return redirect()->to('consumer/'.$id.'/tokens');
    }

    /**
     * @param Request $request
     * @param $id
     * @param $tokenId
     *
     * @return RedirectResponse
     */
    public function getRevokeTokens(Request $request, $id, $tokenId)
    {
        $token = $this->tokenService->getToken($tokenId);

        if (!$token) {
            $request->session()->flash('alert.danger', 'Something went wrong, please try again later!');

            return redirect()->back();
        }

        $this->tokenService->deleteToken($tokenId);

        $request->session()->flash('alert.warning', 'Access tokens successfully revoked!');

        return redirect()->to('consumer/'.$id.'/tokens');
    }
}
