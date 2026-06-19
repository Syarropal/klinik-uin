<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti aturan jamak default Laravel
    protected $table = 'pasiens'; 

    // Daftar kolom yang boleh diisi melalui form/request
    protected $fillable = [
        'nim_nip',
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat'
    ];

    // Tambahkan ini di dalam file app/Models/Pasien.php
public function pendaftaran()
{
    // Hubungan Satu Pasien bisa mendaftar berkali-kali (Has Many)
    return $this->hasMany(Pendaftaran::class, 'pasien_id');
}
}