<?php

namespace App\Http\Controllers;

use App\Models\PenyerahanObat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai query dengan relasi
        $query = PenyerahanObat::with([
            'pasien',
            'pendaftaran.rekamMedis'
        ]);

        // 2. Logika Jalankan Filter jika input tanggal diisi oleh user
        if ($request->filled('tgl_mulai')) {
            $query->whereDate('tanggal_penyerahan', '>=', $request->tgl_mulai);
        }

        if ($request->filled('tgl_selesai')) {
            $query->whereDate('tanggal_penyerahan', '<=', $request->tgl_selesai);
        }

        // 3. Ambil data dengan urutan terbaru di atas
        $laporanPasien = $query->latest('tanggal_penyerahan')->get();

        // 4. Hitung total pendapatan dari hasil yang sudah terfilter
        $totalPendapatan = $laporanPasien->sum('total_harga');

        return view('laporan.laporan', compact(
            'laporanPasien',
            'totalPendapatan'
        ));
    }
}