<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:6|max:16',
            ], [
                'full_name.required' => 'Nama Lengkap tidak boleh kosong',
                'full_name.string' => 'Nama Lengkap harus berupa string',
                'full_name.max' => 'Nama Lengkap maksimal 255 karakter',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 16 karakter',
                'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter spesial',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], Response::HTTP_BAD_REQUEST);
            }

            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->detail()->create([
                'full_name' => $request->full_name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Pendaftaran berhasil',
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Registrasi gagal, silahkan coba lagi',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
