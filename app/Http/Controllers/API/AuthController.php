<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        if (Auth::atempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Auth::User()->createToken('auth')->accessToken;

            return response()->json(['status' => true, 'token' => $token]);
        }

        return response()->json(['status' => false, 'messages' => ['Login or password are incorrect']]);
    }
    public function logout(Request $request) 
    {
        Auth::logout();

        return response()->json(['status' => true]);
    }
}
