<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Resep;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResepController extends Controller
{
    public function index()
    {
        $antreanPasien = Pendaftaran::with('pasien')
                            ->whereDate('tgl_daftar', Carbon::today())
                            ->whereIn('status', ['Menunggu Pemeriksaan', 'Diperiksa'])
                            ->orderBy('no_antrian', 'asc')
                            ->get();

        return view('dokter.resep', compact('antreanPasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required',
            'pasien_id'      => 'required',
            'diagnosa'       => 'required',
            'nama_obat'      => 'required',
            'dosis'          => 'required',
            'jumlah'         => 'required|integer',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);

        // Ambil ID dokter dari yang sedang login
        $dokterId = Auth::id();

        // 1. Simpan ke Rekam Medis
        $rekamMedis = RekamMedis::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id'      => $dokterId,
            'tgl_periksa'    => now()->toDateString(),
            'keluhan'        => $pendaftaran->keluhan_awal ?? '-',
            'diagnosa'       => $request->diagnosa,
            'tindakan'       => $request->tindakan ?? '-',
            'catatan'        => "Obat: {$request->nama_obat} | Dosis: {$request->dosis} | Jml: {$request->jumlah}",
        ]);

        // 2. Simpan ke Tabel Resep
        Resep::create([
            'rekam_medis_id' => $rekamMedis->id,
            'dokter_id'      => $dokterId,
            'tanggal_resep'  => now(),
        ]);

        // 3. Ubah status ke Menunggu Obat
        $pendaftaran->update(['status' => 'Menunggu Obat']);

        return redirect()->route('resep.index')->with('success', 'Pemeriksaan berhasil! Pasien diarahkan ke Apotek.');
    }
}