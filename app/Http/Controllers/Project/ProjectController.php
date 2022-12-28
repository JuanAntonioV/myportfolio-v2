<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::all();

        if (empty($project)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil didapatkan',
            'data' => $project
        ], Response::HTTP_OK);
    }

    public function get(Request $request)
    {
        $project = Project::where('user_id', $request->user()->id)->get();

        if (empty($project)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil didapatkan',
            'data' => $project
        ], Response::HTTP_OK);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'detail' => 'required|string',
            'type' => 'required|string',
            'image_url' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Judul project harus diisi',
            'title.string' => 'Judul project harus berupa string',
            'description.required' => 'Deskripsi project harus diisi',
            'description.string' => 'Deskripsi project harus berupa string',
            'status.required' => 'Status project harus diisi',
            'status.boolean' => 'Status project harus berupa boolean',
            'detail.required' => 'Detail project harus diisi',
            'detail.string' => 'Detail project harus berupa string',
            'type.required' => 'Tipe project harus diisi',
            'type.string' => 'Tipe project harus berupa string',
            'image_url.required' => 'URL gambar project harus diisi',
            'image_url.string' => 'URL gambar project harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal ditambahkan',
                'data' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('id', $request->user()->id)->first();

        $user->project()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil ditambahkan',
            'data' => $project
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'detail' => 'required|string',
            'type' => 'required|string',
            'image_url' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Judul project harus diisi',
            'title.string' => 'Judul project harus berupa string',
            'description.required' => 'Deskripsi project harus diisi',
            'description.string' => 'Deskripsi project harus berupa string',
            'status.required' => 'Status project harus diisi',
            'status.boolean' => 'Status project harus berupa boolean',
            'detail.required' => 'Detail project harus diisi',
            'detail.string' => 'Detail project harus berupa string',
            'type.required' => 'Tipe project harus diisi',
            'type.string' => 'Tipe project harus berupa string',
            'image_url.required' => 'URL gambar project harus diisi',
            'image_url.string' => 'URL gambar project harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal diubah',
                'data' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $project = Project::where('id', $id)->first();

        if (empty($project)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $project->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil diubah',
            'data' => $project
        ], Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        $project = Project::where('id', $id)->first();

        if (empty($project)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $project->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
