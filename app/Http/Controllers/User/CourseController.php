<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::all();

        if (empty($course)) {
            return response()->json([
                'status' => false,
                'message' => 'Data course tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data course berhasil didapatkan',
            'data' => $course
        ], Response::HTTP_OK);
    }

    public function get(Request $request)
    {
        $course = Course::where('user_id', $request->user()->id)->first();

        if (empty($course)) {
            return response()->json([
                'status' => false,
                'message' => 'Data course tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data course berhasil didapatkan',
            'data' => $course
        ], Response::HTTP_OK);
    }

    public function add(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'url' => 'required|string'
        ], [
            'name.required' => 'Nama course harus diisi',
            'name.string' => 'Nama course harus berupa string',
            'url.required' => 'URL course harus diisi',
            'url.string' => 'URL course harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data course gagal ditambahkan',
                'data' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('id', $request->user()->id)->first();

        $user->course()->create([
            'name' => $request->name,
            'url' => $request->url
        ]);

        $course = Course::where('user_id', $user->id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Data course berhasil ditambahkan',
            'data' => $course
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'url' => 'required|string'
        ], [
            'name.required' => 'Nama course harus diisi',
            'name.string' => 'Nama course harus berupa string',
            'url.required' => 'URL course harus diisi',
            'url.string' => 'URL course harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data course gagal ditambahkan',
                'data' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $course = Course::where('id', $id)->first();

        if (empty($course)) {
            return response()->json([
                'status' => false,
                'message' => 'Data course tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $course->update([
            'name' => $request->name,
            'url' => $request->url
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data course berhasil diubah',
            'data' => $course
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $course = Course::where('id', $id)->first();

        if (empty($course)) {
            return response()->json([
                'status' => false,
                'message' => 'Data course tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $course->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data course berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
