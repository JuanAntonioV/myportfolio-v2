<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        if (empty($skills)) {
            return response()->json([
                'status' => false,
                'message' => 'Data skill tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data skill berhasil didapatkan',
            'data' => $skills
        ], Response::HTTP_OK);
    }

    public function get(Request $request)
    {
        $skill = Skill::where('user_id', $request->user()->id)->first();

        if (empty($skill)) {
            return response()->json([
                'status' => false,
                'message' => 'Data skill tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data skill berhasil didapatkan',
            'data' => $skill
        ], Response::HTTP_OK);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'level' => 'required|string'
        ], [
            'name.required' => 'Nama skill harus diisi',
            'name.string' => 'Nama skill harus berupa string',
            'level.required' => 'Level skill harus diisi',
            'level.string' => 'Level skill harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $request->user();

        $user->skill()->create([
            'name' => $request->name,
            'level' => $request->level
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data skill berhasil ditambahkan'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'level' => 'string'
        ], [
            'name.string' => 'Nama skill harus berupa string',
            'level.string' => 'Level skill harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $skill = Skill::findOrFail($id);

        $skill->update([
            'name' => $request->name,
            'level' => $request->level
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data skill berhasil diubah'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $skill = Skill::findOrFail($id);

        $skill->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data skill berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
