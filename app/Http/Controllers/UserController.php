<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register (Request $request) {
        try {
            $newUser = $request -> validate ([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ]);
            $newUser['password'] = Hash::make($request['password']);

            User::create($newUser);
            $newUser['password'] = NULL;
            return response() -> json ([
                'data' => $newUser,
                'message' => 'User Berhasil Ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response() -> json ([
                'status' => false,
                'data' => NULL,
                'message' => $e -> getMessage(),
            ]);
        }
    }

    public function login (Request $request) {
        try {
            $user = $request -> validate ([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ]);
            
            Auth::attempt($user);
        } catch (\Exception $e) {
            return response() -> json ([
                'status' => false,
                'data' => NULL,
                'message' => $e -> getMessage(),
            ]);
        }

        $user = Auth::user();
        if ($user) {
            $token = $user -> createToken('example') -> accessToken;

            return response() -> json (['access_token' => $token]);
        }

        return response() -> json ([
            'status' => false,
            'data' => NULL,
            'message' => 'User tidak ditemukan',
        ]);
    }

    public function loginCheck () {
        return response() -> json ([
            'message' => 'Unauthorized',
        ]);
    }

    public function logout () {
        if (Auth::guard('api') -> check()) {
            $accessToken = Auth::guard('api') -> user() -> token();
            DB::table('oauth_refresh_tokens')
                -> where ('access_token_id', $accessToken -> id)
                -> update (['revoked' => true]);
            $accessToken -> revoke();

            return response() -> json ([
                'message' => 'Logout Berhasil',
            ], 200);
        }

        return response() -> json ([
            'message' => 'Unauthorized',
        ], 401);
    }
}
