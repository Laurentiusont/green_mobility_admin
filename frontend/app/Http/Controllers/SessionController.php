<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use GuzzleHttp\Client;

class SessionController extends Controller
{
    public function setLogin(Request $request)
    {
        $session = new Session();
        $session->set('access_token', $request->access_token);
        $session->set('name', $request->name);
        $session->set('guid', $request->guid);
        $session->set('country', $request->country);

        $client = new Client();
        $response = $client->get('https://api.worldbank.org/v2/country/' . $request->country . '?format=json');
        $json_data = $response->getBody();
        $data = json_decode($json_data, true);
        $incomeLevel = $data[1][0]['incomeLevel']['value'];

        $session->set('class', $incomeLevel);

        return $request->name;
    }

    public function setRegister(Request $request)
    {
        $session = new Session();
        $session->set('guid', $request->guid);

        return $request->guid;
    }

    public function clearSession()
    {
        $session = new Session();
        $session->clear();

        return true;
    }
}
