<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Http\Resources\MatakuliahResource;
use Illuminate\Support\Facades\Validator;

class MatakuliahController extends Controller
{
    // Praktikan Nomor Urut 5
    // Fungsi index menampilkan semua data mata kuliah
    public function index()
    {
        $matakuliahs = MataKuliah::all();
        return MatakuliahResource::collection($matakuliahs);
    }

    // Fungsi show menampilkan detail data mata kuliah berdasarkan id
    public function show($id)
    {
        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }
        return new MatakuliahResource($matakuliah);
    }

    // Praktikan Nomor Urut 6
    // Fungsi store menyimpan data mata kuliah baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|unique:mata_kuliahs,kode|max:255',
            'sks' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah = MataKuliah::create($validator->validated());

        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Ditambahkan!', $matakuliah);
    }

    // Praktikan Nomor Urut 7
    // Fungsi update mengubah data mata kuliah yang dipilih
    public function update(Request $request, $id)
    {
        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|unique:mata_kuliahs,kode,' . $id . '|max:255',
            'sks' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah->update($validator->validated());

        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Diubah!', $matakuliah);
    }

    // Praktikan Nomor Urut 8
    // Fungsi destroy menghapus data mata kuliah yang dipilih
    public function destroy($id)
    {
        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }

        $matakuliah->delete();

        return response()->json(['message' => 'Data Matakuliah Berhasil Dihapus!']);
    }
}