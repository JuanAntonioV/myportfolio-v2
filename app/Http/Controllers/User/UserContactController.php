<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\UserContact;

class UserContactController extends Controller
{

    public function index()
    {
        $contact = UserContact::all();

        if (empty($contact)) {
            return response()->json([
                'status' => false,
                'message' => 'Data kontak tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data kontak berhasil didapatkan',
            'data' => $contact
        ], Response::HTTP_OK);
    }

    public function getContact(Request $request)
    {
        $contact = UserContact::where('user_id', $request->user()->id)->get();

        if (empty($contact)) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengalaman tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pengalaman berhasil didapatkan',
            'data' => $contact
        ], Response::HTTP_OK);
    }

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'url' => 'required|url',
        ], [
            'type.required' => 'Tipe kontak harus diisi',
            'type.string' => 'Tipe kontak harus berupa string',
            'type.regex' => 'Tipe kontak harus berupa huruf',
            'url.required' => 'URL kontak harus diisi',
            'url.url' => 'URL kontak harus berupa URL',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'error' => $validator->errors()->first()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $userContact = UserContact::updateOrCreate([
                'user_id' => $request->user()->id,
                'type' => $request->type,
            ], [
                'url' => $request->url,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil diperbarui',
                'data' => $userContact
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteContact(Request $request, $id)
    {
        $userContact = UserContact::where('user_id', $request->user()->id)->where('id', $id)->first();

        if (!$userContact) {
            return response()->json([
                'status' => false,
                'message' => 'Kontak tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $userContact->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
