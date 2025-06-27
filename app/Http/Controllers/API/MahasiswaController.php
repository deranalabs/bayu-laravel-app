<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * For web: return view with data
     * For API: return JSON collection
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::all();

        if ($request->wantsJson()) {
            return MahasiswaResource::collection($mahasiswas);
        }

        return view('mahasiswa', compact('mahasiswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:10|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|max:10',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255'
        ]);
        $mahasiswa = Mahasiswa::create($request->all());
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'success' => true,
                'message' => 'Mahasiswa created successfully'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findorfail($id);
        return response()->json($mahasiswa);
    }

    /**
     * Edit the specified resource for web (return JSON).
     */
    public function edit($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nim' => 'required|string|max:10|unique:mahasiswas,nim,' . $id . ',nim',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|max:10',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255'
        ]);
        $mahasiswa = Mahasiswa::findorfail($id);
        $mahasiswa->update($request->all());
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'success' => true,
                'message' => 'Mahasiswa updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findorfail($id);
        $mahasiswa->delete();
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'success' => true,
                'message' => 'Mahasiswa deleted successfully'
            ]);
    }
}
