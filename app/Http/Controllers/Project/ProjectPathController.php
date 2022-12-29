<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectPath;

class ProjectPathController extends Controller
{
    public function index()
    {
        $projectPath = ProjectPath::all();

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil didapatkan',
            'data' => $projectPath
        ], Response::HTTP_OK);
    }

    public function get(Request $request, $id)
    {
        $projectPath = ProjectPath::where('project_id', $id)->first();

        if (empty($projectPath)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil didapatkan',
            'data' => $projectPath
        ], Response::HTTP_OK);
    }

    public function add(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:project_paths,name',
            'url' => 'required|string|url',
        ], [
            'name.required' => 'Nama teknologi harus diisi',
            'name.string' => 'Nama teknologi harus berupa string',
            'url.required' => 'URL project harus diisi',
            'url.string' => 'URL project harus berupa string',
            'url.url' => 'URL project harus berupa URL',
            'name.unique' => 'Nama teknologi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $projectPath = ProjectPath::create([
            'project_id' => $projectId,
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil ditambahkan',
            'data' => $projectPath
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|unique:project_paths,name',
            'url' => 'string|url',
        ], [
            'name.string' => 'Nama teknologi harus berupa string',
            'url.string' => 'URL project harus berupa string',
            'url.url' => 'URL project harus berupa URL',
            'name.unique' => 'Nama teknologi sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $projectPath = ProjectPath::where('id', $id)->first();

        if (empty($projectPath)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $projectPath->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil diubah',
            'data' => $projectPath
        ], Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        $projectPath = ProjectPath::where('id', $id)->first();

        if (empty($projectPath)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $projectPath->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
