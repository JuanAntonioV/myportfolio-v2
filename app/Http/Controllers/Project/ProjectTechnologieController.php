<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectTechnologie;

class ProjectTechnologieController extends Controller
{
    public function index()
    {
        $projectTechnologie = ProjectTechnologie::all();

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil didapatkan',
            'data' => $projectTechnologie
        ], Response::HTTP_OK);
    }

    public function get(Request $request, $id)
    {
        $projectTechnologie = ProjectTechnologie::where('project_id', $id)->first();

        if (empty($projectTechnologie)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil didapatkan',
            'data' => $projectTechnologie
        ], Response::HTTP_OK);
    }

    public function add(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ], [
            'name.required' => 'Nama teknologi harus diisi',
            'name.string' => 'Nama teknologi harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal ditambahkan',
                'data' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $projectTechnologie = Project::where('id', $projectId)->first();

        $projectTechnologie->projectTechnologie()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil ditambahkan',
            'data' => $projectTechnologie
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
        ], [
            'name.string' => 'Nama teknologi harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data project gagal ditambahkan',
                'data' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $projectTechnologie = ProjectTechnologie::where('id', $id)->first();

        if (empty($projectTechnologie)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $projectTechnologie->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil diubah',
            'data' => $projectTechnologie
        ], Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        $projectTechnologie = ProjectTechnologie::where('id', $id)->first();

        if (empty($projectTechnologie)) {
            return response()->json([
                'status' => false,
                'message' => 'Data project tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $projectTechnologie->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data project berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
