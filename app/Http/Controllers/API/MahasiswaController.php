<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;

class MahasiswaController extends Controller
{
    // Tampilkan semua data mahasiswa
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::all();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => MahasiswaResource::collection($mahasiswas)
            ]);
        }

        return view('mahasiswa', compact('mahasiswas'));
    }

    // Simpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|max:10',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255'
        ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'success' => true,
            'data' => new MahasiswaResource($mahasiswa),
            'message' => 'Mahasiswa created successfully'
        ]);
    }

    // Ambil data mahasiswa berdasarkan NIM
    public function show(string $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);

        return response()->json([
            'success' => true,
            'data' => new MahasiswaResource($mahasiswa)
        ]);
    }

    // Update data mahasiswa berdasarkan NIM
    public function update(Request $request, string $nim)
    {
$request->validate([
            'nim' => 'required|string|max:10|unique:mahasiswas,nim,' . $nim . ',nim',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($nim);
        $mahasiswa->update($request->all());

        return response()->json([
            'success' => true,
            'data' => new MahasiswaResource($mahasiswa),
            'message' => 'Mahasiswa updated successfully'
        ]);
    }

    // Hapus data mahasiswa berdasarkan NIM
    public function destroy(string $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'data' => new MahasiswaResource($mahasiswa),
            'message' => 'Mahasiswa deleted successfully'
        ]);
    }
}
