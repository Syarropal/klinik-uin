<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('pasien')
            ->whereDate('tgl_daftar', Carbon::today())
            ->orderBy('no_antrian', 'asc')
            ->get();

        $pasiens = Pasien::all();

        return view('pendaftaran.index', compact(
            'pendaftarans',
            'pasiens'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasiens,id',
            'keluhan_awal' => 'required|string'
        ]);

        $tanggalHariIni = Carbon::today();

        $antrianTerakhir = Pendaftaran::whereDate(
                'tgl_daftar',
                $tanggalHariIni
            )
            ->max('no_antrian');

        $noAntrianBaru = ($antrianTerakhir ?? 0) + 1;

        Pendaftaran::create([
            'pasien_id'     => $request->id_pasien,
            'no_antrian'    => $noAntrianBaru,
            'tgl_daftar'    => now(),
            'keluhan_awal'  => $request->keluhan_awal,
            'status'        => 'Menunggu Pemeriksaan'
        ]);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Pasien berhasil masuk antrean nomor '.$noAntrianBaru);
    }
}