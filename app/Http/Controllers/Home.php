<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;

class Home extends Controller
{
    protected HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        return $this->homeService->index();
    }

    public function auth(Request $request)
    {
        return $this->homeService->auth($request);
    }

    public function logout(Request $request)
    {
        return $this->homeService->logout($request);
    }
}