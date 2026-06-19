<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // 1. Menampilkan DAFTAR PASIEN yang unik + Fitur Pencarian Nama/NIM/NIP
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari form input text 'search'
        $search = $request->input('search');

        // Mengambil data pasien unik secara murni menggunakan Query Builder bawaan Laravel
        $queryPasien = Pasien::whereIn('id', function($query) {
            $query->select('pasien_id')
                  ->from('pendaftarans')
                  ->whereIn('id', function($q) {
                      $q->select('pendaftaran_id')->from('rekam_medis');
                  });
        });

        // JIKA DOKTER MELAKUKAN PENCARIAN
        if (!empty($search)) {
            $queryPasien->where(function($q) use ($search) {
                $q->where('nama_pasien', 'LIKE', "%{$search}%")
                  ->orWhere('nim_nip', 'LIKE', "%{$search}%");
            });
        }

        // Eksekusi query ambil data
        $semuaPasien = $queryPasien->get();

        // Sesuaikan nama view-nya (rekam_medis.index atau dokter.rekam-medis sesuai route kamu)
        // Di sini saya arahkan ke folder yang biasa dipakai laravel
        return view('rekam_medis.index', compact('semuaPasien'));
    }

    // 2. Menampilkan DETAIL RIWAYAT PENYAKIT dari satu pasien tertentu
    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);

        // Ambil semua rekam medis milik pasien ini saja menggunakan subquery murni (aman dari error relasi)
        $riwayatMedis = RekamMedis::whereIn('pendaftaran_id', function($query) use ($id) {
            $query->select('id')
                  ->from('pendaftarans')
                  ->where('pasien_id', $id);
        })->latest()->get();

        return view('rekam_medis.show', compact('pasien', 'riwayatMedis'));
    }
}