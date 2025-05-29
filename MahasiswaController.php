<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Daftar data mahasiswa',
            'data' => $mahasiswa
        ]);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data mahasiswa',
                'data' => $mahasiswa
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'studentId' => 'required|string|unique:mahasiswas,studentId',
            'department' => 'required|string',
            'faculty' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::create($request->only('name', 'studentId', 'department', 'faculty'));

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::find($id);
    if (!$mahasiswa) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'nama' => 'required|string',
        'nim' => 'required|string|unique:mahasiswas,nim,' . $id,
        'jurusan' => 'required|string',
        'fakultas' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422);
    }

    $mahasiswa->update($request->only('nama', 'nim', 'jurusan', 'fakultas'));

    return response()->json([
        'success' => true,
        'message' => 'Data Mahasiswa Berhasil Diubah!',
        'data' => $mahasiswa
    ]);
}

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Mahasiswa Berhasil Dihapus!'
        ]);
    }
}