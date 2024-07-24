<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class RewardController extends Controller
{
    public function index()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $country = $session->get('country');

        return view('reward.index', compact('token', 'id', 'name','country', 'session'));
    }

    // public function indexInsert()
    // {
    //     $session = new Session();
    //     $token = $session->get('access_token');

    //     return view('dashboard.projectmaster.insert', compact('token', 'session'));
    // }

    // public function indexEdit($guid)
    // {
    //     $session = new Session();
    //     $token = $session->get('access_token');

    //     $response = Http::withHeaders([
    //         'Authorization' => "Bearer " . $token,
    //         'Content-Type' => "application/json"
    //     ])->get(env("URL_API", "http://example.com") . '/api/v1/projectmaster/' . $guid);

    //     $data = json_decode($response, true);

    //     return view('dashboard.projectmaster.edit', compact('token', 'data', 'session'));
    // }
}