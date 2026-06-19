<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PenyerahanObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApotekerController extends Controller
{
    public function index()
    {
        $pasienSelesai = Pendaftaran::with([
            'pasien',
            'rekamMedis'
        ])
        ->where('status', 'Menunggu Obat')
        ->orderBy('id')
        ->get();

        return view('apoteker.index', compact('pasienSelesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required',
            'nama_obat'      => 'required',
            'dosis'          => 'required',
            'jumlah'         => 'required|integer|min:1',
            'harga_satuan'   => 'required|integer|min:0',
            'aturan_pakai'   => 'nullable'
        ]);

        $pendaftaran = Pendaftaran::findOrFail(
            $request->pendaftaran_id
        );

        $totalHarga =
            $request->harga_satuan *
            $request->jumlah;

        PenyerahanObat::create([
            'pasien_id'          => $pendaftaran->pasien_id,
            'pendaftaran_id'     => $pendaftaran->id,
            'nama_obat'          => $request->nama_obat,
            'dosis'              => $request->dosis,
            'jumlah'             => $request->jumlah,
            'aturan_pakai'       => $request->aturan_pakai,
            'harga_satuan'       => $request->harga_satuan,
            'total_harga'        => $totalHarga,
            'petugas'            => Auth::user()->nama_lengkap,
            'tanggal_penyerahan' => now(),
        ]);

        $pendaftaran->status = 'Selesai';
        $pendaftaran->save();

        return redirect()
            ->route('apoteker.index')
            ->with('success', 'Obat berhasil diserahkan!');
    }
}