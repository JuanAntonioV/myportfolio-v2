<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Resume;
use App\Models\User;

class ResumeController extends Controller
{
    public function index()
    {
        $resume = Resume::all();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil didapatkan',
            'data' => $resume
        ], Response::HTTP_OK);
    }

    public function get(Request $request)
    {
        $resume = Resume::where('user_id', $request->user()->id)->get();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil didapatkan',
            'data' => $resume
        ], Response::HTTP_OK);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Judul resume harus diisi',
            'title.string' => 'Judul resume harus berupa string',
            'status.required' => 'Status resume harus diisi',
            'status.boolean' => 'Status resume harus berupa boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::find($request->user()->id);

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $resume = $user->resume->create([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil ditambahkan',
            'data' => $resume
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'status' => 'boolean',
        ], [
            'title.string' => 'Judul resume harus berupa string',
            'status.boolean' => 'Status resume harus berupa boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $resume = Resume::where('id', $id)->first();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $resume->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil diubah',
            'data' => $resume
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $resume = Resume::where('id', $id)->first();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $resume->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
