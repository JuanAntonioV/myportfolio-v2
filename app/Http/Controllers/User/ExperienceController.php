<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Experience;
use App\Models\User;

class ExperienceController extends Controller
{
    public function index()
    {
        $experience = Experience::all();

        if (empty($experience)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil didapatkan',
            'data' => $experience
        ], Response::HTTP_OK);
    }

    public function get(Request $request)
    {
        $experience = Experience::with('jobdesk')->where('user_id', $request->user()->id)->get();

        if (empty($experience)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil didapatkan',
            'data' => $experience
        ], Response::HTTP_OK);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'company' => 'required|string',
            'location' => 'nullable|string',
            'url' => 'nullable|string|url',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Judul pekerjaan tidak boleh kosong',
            'title.string' => 'Judul pekerjaan harus berupa string',
            'company.required' => 'Nama perusahaan tidak boleh kosong',
            'company.string' => 'Nama perusahaan harus berupa string',
            'location.string' => 'Lokasi perusahaan harus berupa string',
            'started_at.required' => 'Tanggal mulai tidak boleh kosong',
            'started_at.date' => 'Tanggal mulai harus berupa tanggal',
            'ended_at.required' => 'Tanggal selesai tidak boleh kosong',
            'ended_at.date' => 'Tanggal selesai harus berupa tanggal',
            'status.required' => 'Status tidak boleh kosong',
            'status.boolean' => 'Status harus berupa boolean',
            'url.url' => 'URL harus berupa URL',
            'url.string' => 'URL harus berupa string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $experience = Experience::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'started_at' => $request->started_at,
            'ended_at' => $request->ended_at,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil ditambahkan',
            'data' => $experience
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'company' => 'string',
            'location' => 'string',
            'url' => 'string|url',
            'started_at' => 'date',
            'ended_at' => 'date',
            'status' => 'boolean',
        ], [
            'title.string' => 'Judul pekerjaan harus berupa string',
            'company.string' => 'Nama perusahaan harus berupa string',
            'location.string' => 'Lokasi perusahaan harus berupa string',
            'started_at.date' => 'Tanggal mulai harus berupa tanggal',
            'ended_at.date' => 'Tanggal selesai harus berupa tanggal',
            'status.boolean' => 'Status harus berupa boolean',
            'url.url' => 'URL harus berupa URL',
            'url.string' => 'URL harus berupa string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $experience = Experience::where('id', $id)->first();

        if(empty($experience)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($experience->user_id != $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $experience->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil diubah',
            'data' => $experience
        ], Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        $experience = Experience::where('id', $id)->first();

        if(empty($experience)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($experience->user_id != $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $experience->delete();

        $jobDesk = JobDesk::where('experience_id', $id)->get();

        if(!empty($jobDesk)) {
            foreach ($jobDesk as $key => $value) {
                $value->delete();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
