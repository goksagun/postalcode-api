<?php

namespace App\Http\Controllers;


use App\Services\ConsumerService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var ConsumerService
     */
    protected $consumerService;

    /**
     * AuthController constructor.
     *
     * @param UserService $userService
     * @param ConsumerService $consumerService
     */
    public function __construct(UserService $userService, ConsumerService $consumerService)
    {
        $this->userService = $userService;
        $this->consumerService = $consumerService;
    }

    /**
     * @return View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postRegister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|confirmed|unique:users',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        if (!$this->userService->createUser($request->only(['name', 'email', 'password']))) {
            $request->session()->flash('alert.warning', 'Something went wrong, please try again later!');
        }

        $request->session()->flash('alert.success', 'Your account has been created, please login your credentials.');

        return redirect('auth/login');
    }

    /**
     * @return View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        if (Auth::attempt($request->only(['email', 'password']))) {
            // Authentication passed...
            return redirect()->to('consumers');
        }

        $request->session()->flash('alert.danger', 'Email or password wrong, please try again!');

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->to('auth/login');
    }
}