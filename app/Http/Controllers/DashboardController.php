<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');

        return view('home', compact('token', 'id', 'name', 'session'));
    }
    public function about(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
            
        
        return view('about', compact('token', 'id', 'name', 'session'));
    }
    public function lomba(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantlocation');

        $data = json_decode($response, true);

        $responsePark = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/parkinglot');

        $dataPark = json_decode($responsePark, true);
    
        // dd( $data);
        return view('testlomba.index', compact('token', 'id', 'name', 'data', 'dataPark', 'session'));
    }
    
    
}
