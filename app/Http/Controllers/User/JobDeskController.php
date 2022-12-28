<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\ExperienceJobdesk;
use App\Models\Experience;

class JobDeskController extends Controller
{
    public function get(Request $request, $expId)
    {
        $jobdesk = ExperienceJobdesk::where('experience_id', $expId)->get();

        if (empty($jobdesk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data jobdesk tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil didapatkan',
            'data' => $jobdesk
        ], Response::HTTP_OK);
    }

    public function add(Request $request, $expId)
    {
        $validator = Validator::make($request->all(), [
            'jobdesk' => 'required|string'
        ], [
            'jobdesk.required' => 'Jobdesk harus diisi',
            'jobdesk.string' => 'Jobdesk harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $experience = Experience::where('id', $expId)->first();

        if (empty($experience)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $experience->jobdesk()->create([
            'jobdesk' => $request->jobdesk
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil ditambahkan'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jobdesk' => 'required|string'
        ], [
            'jobdesk.required' => 'Jobdesk harus diisi',
            'jobdesk.string' => 'Jobdesk harus berupa string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $jobdesk = ExperienceJobdesk::where('id', $id)->first();

        if (empty($jobdesk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data jobdesk tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $jobdesk->update([
            'jobdesk' => $request->jobdesk
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil diubah'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $jobdesk = ExperienceJobdesk::where('id', $id)->first();

        if (empty($jobdesk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data jobdesk tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $jobdesk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data jobdesk berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
