<?php

namespace App\Http\Controllers;

use App\Http\Resources\WilayahResource;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        try {
            return WilayahResource::collection(Wilayah::all());
        } catch (\Exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data wilayah'
            ], 500);
        }
    }

    public function show($wilayahId)
    {
        try {
            $wilayahId = Wilayah::findOrFail($wilayahId);
            return new WilayahResource($wilayahId);
        } catch (\Exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID Wilayah tidak ditemukan'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'nama' => 'required|string|max:255|min:3',
            ]
        );

        try {
            if (Wilayah::where('id', $request->id)->exists()) {
                return response()->json(['message' => 'ID sudah digunakan'], 400);
            }
            $wilayah = Wilayah::create($request->all());
            return new WilayahResource($wilayah);
        } catch (\Exception) {
            return response()->json(['message' => 'Gagal membuat Wilayah'], 500);
        }
    }

    public function update(Request $request, $wilayahId)
    {
        try {
            $wilayahId = Wilayah::findOrFail($wilayahId);
            $wilayahId->update($request->all());
            return new WilayahResource($wilayahId);
        } catch (\Exception) {
            return response()->json(['message' => 'Gagal memperbarui Wilayah'], 500);
        }
    }

    public function destroy($wilayahId)
    {
        try {
            $wilayah = Wilayah::findOrFail($wilayahId);
            $wilayah->delete();
            return response()->json(['message' => 'Wilayah berhasil dihapus'], 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Gagal menghapus Wilayah'], 500);
        }
    }
}
