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
            'detail' => 'required|string',
            'type' => 'required|string',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Judul project harus diisi',
            'title.string' => 'Judul project harus berupa string',
            'status.required' => 'Status project harus diisi',
            'status.boolean' => 'Status project harus berupa boolean',
            'detail.required' => 'Detail project harus diisi',
            'detail.string' => 'Detail project harus berupa string',
            'type.required' => 'Tipe project harus diisi',
            'type.string' => 'Tipe project harus berupa string',
            'image.required' => 'URL gambar project harus diisi',
            'image.file' => 'URL gambar project harus berupa file',
            'image.mimes' => 'URL gambar project harus berupa file dengan ekstensi jpg, jpeg, atau png',
            'image.max' => 'URL gambar project harus berupa file dengan ukuran maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal ditambahkan',
                'data' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $filename = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $filename);
        $validasi['image'] = $path;

        $project = Project::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'detail' => $request->detail,
            'type' => $request->type,
            'image' => $path,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil ditambahkan',
            'data' => $project
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'detail' => 'string',
            'type' => 'string',
            'status' => 'boolean',
        ], [
            'title.string' => 'Judul project harus berupa string',
            'status.boolean' => 'Status project harus berupa boolean',
            'detail.string' => 'Detail project harus berupa string',
            'type.string' => 'Tipe project harus berupa string',
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

    public function updateImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'image.required' => 'URL gambar project harus diisi',
            'image.file' => 'URL gambar project harus berupa file',
            'image.mimes' => 'URL gambar project harus berupa file dengan ekstensi jpg, jpeg, atau png',
            'image.max' => 'URL gambar project harus berupa file dengan ukuran maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal diubah',
                'data' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $project = Project::where('id', $id)->first();

        if (empty($project)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $oldFile = $project->image;

        if (file_exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        $filename = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $filename);
        $validasi['image'] = $path;

        $project->update([
            'image' => $path,
        ]);

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

        $project->projectTechnologie()->delete();
        $project->projectPath()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
