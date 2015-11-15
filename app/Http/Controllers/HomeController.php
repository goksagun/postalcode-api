<?php

namespace App\Http\Controllers;

use App\Services\ConsumerService;
use App\Services\UserService;
use Illuminate\View\View;

class HomeController extends Controller
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

    public function __construct(UserService $userService, ConsumerService $consumerService)
    {
        $this->userService = $userService;
        $this->consumerService = $consumerService;
    }

    /**
     * @return View
     */
    public function getHome()
    {
        return view('home.index');
    }
}
