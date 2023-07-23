<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            //cek credential
            $credential = request(['email', 'password']);
            if(!Auth::attempt($credential)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            //jika credential tidak sesuai
            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('invalid credential');
            }
            //jika berhasil maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');

        }
        catch(Exception $error){
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'token revoked');
    }
}
