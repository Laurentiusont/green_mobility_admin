<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $guid = $session->get('guid');

        return view('form.index', compact('token', 'id', 'name', 'guid', 'session'));
    }

    public function result(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $guid = $session->get('guid');

        $resultAPI = Http::withHeaders([
            'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/form/datatable');
        $dataResult = $resultAPI->json();

        return view('result.index', compact('token', 'id', 'name', 'dataResult', 'guid', 'session'));
    }
}
