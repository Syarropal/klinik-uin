<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // 1. TAMPILKAN DAFTAR PASIEN
    public function index()
    {
        $pasiens = Pasien::latest()->get();
        return view('pasien.index', compact('pasiens')); // Diubah dari admin.pasien.index
    }

    // 2. TAMPILKAN FORM TAMBAH PASIEN
    public function create()
    {
        return view('pasien.create'); // Diubah dari admin.pasien.create
    }

    // 3. SIMPAN DATA PASIEN BARU
    public function store(Request $request)
    {
        $request->validate([
            'nim_nip' => 'required|unique:pasiens,nim_nip',
            'nama_pasien' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string'
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    // 4. TAMPILKAN DETAIL PASIEN (Jika dibutuhkan)
    public function show(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.show', compact('pasien'));
    }

   // 5. TAMPILKAN FORM EDIT PASIEN
    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien')); // Diubah dari admin.pasien.edit
    }

    // 6. UPDATE DATA PASIEN DI DATABASE
    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'nim_nip' => 'required|unique:pasiens,nim_nip,' . $id,
            'nama_pasien' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string'
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    // 7. HAPUS DATA PASIEN
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}