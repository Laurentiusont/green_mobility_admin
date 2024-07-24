<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client;

class AuthController extends Controller
{

    public function loginGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $user = User::where([
            ['users.google_id', '=', $request['google_id']],
        ])
            ->first();

        if (empty($user)) {
            return ResponseController::getResponse(null, 400, "Invalid Credentials");
        }
        // $request->ipinfo->ip = "103.147.8.74";
        // $country = $request->ipinfo->all;
        // $userIp = $request->ip();
        // $client = new Client();
        // $response = $client->get("https://ipinfo.io/103.147.8.74?token=9a9513b7752d5e");
        // $data = json_decode($response->getBody());
        // $code = $data->country;
        // $json_data = file_get_contents(asset('./countries.json'));
        // $data = json_decode($json_data, true);
        // $country = $data[$code];
        // if (isset($code)) {
        //     $user->country = $code;
        //     $user->save();
        // }

        $payloadable = [
            'user_guid' => $user->guid,
            'name' => $user->name,
            'email' => $user->email,
        ];

        $token = JWTAuth::fromUser($user, $payloadable);

        $response = [
            "access_token" => $token,
        ];

        return ResponseController::getResponse($response, 200, 'Login Success');
    }
    public function syncGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $user = User::where('guid', auth('api')->user()->guid)
            ->first();

        $existingUser = User::where('email', $request['email'])->where('guid', '!=', $user->guid)->first();

        if ($existingUser) {
            return ResponseController::getResponse(null, 400, "Account Already Exists");
        } else {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->google_id = $request['google_id'];
            $user->save();
        }

        return ResponseController::getResponse($user, 200, 'Sync Success');
    }

    public function verifyGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'guid' => 'required|string|max:36',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $user = User::where('guid', $request['guid'])->first();
        if ($request['email'] != $user['email']) {
            return ResponseController::getResponse(null, 400, "Email Google are Different");
        }

        $user->email = $request['email'];
        $user->google_id = $request['google_id'];
        $user->email_verified_at = Carbon::now();
        $user->save();


        return ResponseController::getResponse($user, 200, 'Verify Success');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $user = User::where([
            ['users.email', '=', $request['email']],
        ])
            ->first();

        if (empty($user)) {
            return ResponseController::getResponse(null, 400, "User Not Found");
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return ResponseController::getResponse(null, 400, "Invalid Credentials");
        }

        if (empty($user->email_verified_at)) {
            return ResponseController::getResponse(null, 400, "Email Not Verify");
        }

        // $userIp = $request->ip();
        // $client = new Client();
        // $response = $client->get("https://ipinfo.io/103.147.8.74?token=9a9513b7752d5e");
        // $data = json_decode($response->getBody());
        // $code = $data->country;
        // $json_data = file_get_contents(asset('./countries.json'));
        // $data = json_decode($json_data, true);
        // $country = $data[$code];
        // if (isset($code)) {
        //     $user->country = $code;
        //     $user->save();
        // }
        $payloadable = [
            'user_id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
        ];

        $token = JWTAuth::fromUser($user, $payloadable);

        $respone = [
            "access_token" => $token,
        ];

        return ResponseController::getResponse($respone, 200, 'Login Success');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        return ResponseController::getResponse($user, 200, 'User Create Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
