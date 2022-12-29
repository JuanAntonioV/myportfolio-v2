<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil didapatkan',
            'data' => $users
        ], Response::HTTP_OK);
    }

    public function getUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $user->with(['detail', 'contact', 'resume', 'project', 'experience', 'skill', 'course'])->find($id);

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil didapatkan',
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function updateUserDetail(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'biography' => 'string',
                'position' => 'string',
                'birthday' => 'date|before:today',
            ], [
                'full_name.required' => 'Nama lengkap tidak boleh kosong',
                'biography.string' => 'Biografi tidak valid',
                'position.string' => 'Posisi tidak valid',
                'birthday.date' => 'Tanggal lahir tidak valid',
                'birthday.before' => 'Tanggal lahir tidak valid',
                'birthday.before_or_equal' => 'Tanggal lahir tidak valid',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], Response::HTTP_BAD_REQUEST);
            }

            $user->detail()->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data detail berhasil diperbarui',
                'data' => $user->detail
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function profile(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        $data = $user->with(['detail', 'contact', 'resume', 'project', 'experience', 'skill', 'course'])->find($user->id);

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil didapatkan',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
