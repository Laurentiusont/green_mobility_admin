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

    public function syncToGoogle()
    {
        config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back/sync']);
        return Socialite::driver('google')->redirect();
    }

    public function verifyToGoogle()
    {
        config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back/verify']);
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
            ])->post(env("URL_API", "http://example.com") . '/api/v1/auth/login-google', [
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
                    $session->set('country', $data['data']['country']);


                    $client = new Client();
                    $response = $client->get('https://api.worldbank.org/v2/country/' . $data['data']['country'] . '?format=json');
                    $json_data = $response->getBody();
                    $data = json_decode($json_data, true);
                    $incomeLevel = $data[1][0]['incomeLevel']['value'];
                    $session->set('class', $incomeLevel);
                    return redirect('dashboard');
                } else {
                    dd("error");
                }
            } else {
                // Tampilkan pesan error ke konsol jika tidak berhasil
                $errorData = $response->json(); // Mendapatkan data error dalam bentuk array atau objek JSON
                $errorMessage = isset($errorData['message']) ? $errorData['message'] : 'Unknown error';
                dd($response);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleCallbackSync()
    {
        try {
            config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back/sync']);

            $user = Socialite::driver('google')->user();
            $session = new Session();
            $token = $session->get('access_token');
            $response = Http::withHeaders([
                'Authorization' => "Bearer " . $token,
                'Content-Type' => "application/json"
            ])->post(env("URL_API", "http://example.com") . '/api/v1/user/sync-google', [
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email

            ]);

            if ($response->successful()) {
                $session->set('name', $response['data']['name']);

                return redirect()->route('user-profile');
            } else {
                $errorData = $response->json();
                $errorMessage = isset($errorData['message']) ? $errorData['message'] : 'Unknown error';
                dd($response);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleCallbackVerify()
    {
        try {
            config(['services.google.redirect' => 'http://127.0.0.1:8000/auth/google/call-back/verify']);

            $user = Socialite::driver('google')->user();
            $session = new Session();
            $guid = $session->get('guid');
            $response = Http::withHeaders([
                'Content-Type' => "application/json"
            ])->post(env("URL_API", "http://example.com") . '/api/v1/auth/verify-google', [
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'guid' => $guid

            ]);

            if ($response->successful()) {
                return redirect()->route('login');
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
