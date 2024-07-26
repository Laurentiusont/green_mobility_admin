<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $country = $session->get('country');
        $category = $session->get('class');

        return view('home', compact('token', 'id', 'name', 'country','category', 'session'));
    }
}
