<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|exists:users',
                'password' => 'required|string',
            ], [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.exists' => 'Email tidak terdaftar',
                'password.required' => 'Password tidak boleh kosong',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], Response::HTTP_BAD_REQUEST);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email atau password salah'
                ], Response::HTTP_BAD_REQUEST);
            }

            $token = $user->createToken('loginToken')->plainTextToken;

            $agent = new Agent();

            $user->loginLog()->create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'device' => $agent->device(),
                'browser' => $agent->browser(),
                'token' => $token,
                'login_at' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'token' => $token,
                    'user' => $user
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Login gagal, silahkan coba lagi',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        $request->user()->loginLog()->where('token', $token)->update([
            'logout_at' => now(),
        ]);

        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ], Response::HTTP_OK);
    }
}
