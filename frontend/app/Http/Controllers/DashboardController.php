<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardController extends Controller
{
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
