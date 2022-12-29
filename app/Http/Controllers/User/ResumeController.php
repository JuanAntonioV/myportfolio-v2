<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\UserResume;
use App\Models\User;

class ResumeController extends Controller
{
    public function index()
    {
        $resume = UserResume::all();

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
        $resume = UserResume::where('user_id', $request->user()->id)->get();

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
        try {
            $validator = Validator::make($request->all(), [
                'value' => 'required|file|mimes:pdf|max:1024',
                'status' => 'required|boolean',
            ], [
                'value.required' => 'File resume harus diisi',
                'value.file' => 'File resume harus berupa file',
                'value.mimes' => 'File resume harus berupa file pdf',
                'value.max' => 'File resume maksimal 1 MB',
                'status.required' => 'Status resume harus diisi',
                'status.boolean' => 'Status resume harus berupa boolean',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], Response::HTTP_BAD_REQUEST);
            }
    
            $filename = time() . '-' . str_replace(' ', '', $request->file('value')->getClientOriginalName());
            $path = $request->file('value')->storeAs('resume', $filename);
            $validasi['value'] = $path;
    
            $resume = UserResume::create([
                'user_id' => $request->user()->id,
                'value' => $path,
                'status' => $request->status,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Data resume berhasil ditambahkan',
                'data' => $resume
            ], Response::HTTP_CREATED);
        } catch (\Exepction $th) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume gagal ditambahkan',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|boolean',
            ], [
                'status.boolean' => 'Status resume harus berupa boolean',
                'status.required' => 'Status resume harus diisi',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], Response::HTTP_BAD_REQUEST);
            }
    
            $resume = UserResume::where('id', $id)->first();
    
            if (empty($resume)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data resume tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            $resume->update([
                'user_id' => $request->user()->id,
                'status' => $request->status,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Data resume berhasil diubah',
                'data' => $resume
            ], Response::HTTP_OK);
        } catch (\Exepction $th) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume gagal diubah',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateFile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|file|mimes:pdf|max:1024',
        ], [
            'value.required' => 'File resume harus diisi',
            'value.file' => 'File resume harus berupa file',
            'value.mimes' => 'File resume harus berupa file pdf',
            'value.max' => 'File resume maksimal 1 MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $resume = UserResume::where('id', $id)->first();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $oldFile = $resume->value;

        if (file_exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        $filename = time() . '-' . str_replace(' ', '', $request->file('value')->getClientOriginalName());
        $path = $request->file('value')->storeAs('resume', $filename);
        $validasi['value'] = $path;

        $resume->update([
            'value' => $path,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil ditambahkan',
            'data' => $resume
        ], Response::HTTP_CREATED);
        
    }

    public function delete($id)
    {
        $resume = UserResume::where('id', $id)->first();

        if (empty($resume)) {
            return response()->json([
                'status' => false,
                'message' => 'Data resume tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $resume->delete();

        $oldFile = $resume->value;

        if (file_exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        return response()->json([
            'status' => true,
            'message' => 'Data resume berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
