<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    public function predikat_kinerja(Request $request)
    {
        $validated = $request->validate([
            'hasil_kerja' => 'required|string|in:dibawah ekspektasi,sesuai ekspektasi,diatas ekspektasi',
            'perilaku' => 'required|string|in:dibawah ekspektasi,sesuai ekspektasi,diatas ekspektasi',
        ]);

        $matriks = [
            'dibawah ekspektasi' => [
                'dibawah ekspektasi' => 'Sangat Kurang',
                'sesuai ekspektasi' => 'Butuh perbaikan',
                'diatas ekspektasi' => 'Butuh perbaikan',
            ],
            'sesuai ekspektasi' => [
                'dibawah ekspektasi' => 'Baik',
                'sesuai ekspektasi' => 'Baik',
                'diatas ekspektasi' => 'Baik',
            ],
            'diatas ekspektasi' => [
                'dibawah ekspektasi' => 'Sangat Kurang',
                'sesuai ekspektasi' => 'Baik',
                'diatas ekspektasi' => 'Sangat Baik',
            ],
        ];

        $predikat_kinerja = $matriks[$validated['hasil_kerja']][$validated['perilaku']];
        return response()->json(["predikat_kinerja" => $predikat_kinerja]);
    }
}
