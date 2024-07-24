<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class FormController extends Controller
{
    public function index()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $guid = $session->get('guid');
        $name = $session->get('name');
        $class = $session->get('class');
        return view('form.index', compact('token', 'guid', 'name', 'session'));
    }
    public function result($form)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $guid = $session->get('guid');
        $name = $session->get('name');
        $class = $session->get('class');
        return view('form.result', compact('token', 'guid', 'name', 'form', 'session'));
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
