<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Dotenv\Dotenv;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class GoogleController extends Controller
{
    //tambahkan script di bawah ini
    public function redirectToGoogle()
    {
        config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back']);
        return Socialite::driver('google')->redirect();
    }


    //tambahkan script di bawah ini 
    public function handleCallback()
    {
        try {
            config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back']);
            $user = Socialite::driver('google')->user();
            // dd($user->id);
            $response = Http::withHeaders([
                'Content-Type' => "application/json"
            ])->post(env("URL_API", "http://example.com") . '/api/v1/auth/verify-google', [
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email

            ]);
            if ($response->successful()) {
                $data = Http::withHeaders([
                    'Authorization' => "Bearer " . $response['data']['access_token'],
                    'Content-Type' => "application/json"
                ])->get(env("URL_API", "http://example.com") . '/api/v1/user/self');
                if ($data->successful()) {
                    $session = new Session();
                    $session->set('access_token', $response['data']['access_token']);
                    $session->set('name', $data['data']['name']);
                    $session->set('guid', $data['data']['guid']);

                    return redirect('dashboard');
                } else {
                    dd("error");
                }
            } else {
                $errorData = $response->json();
                $errorMessage = isset($errorData['message']) ? $errorData['message'] : 'Unknown error';
                dd($response);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
