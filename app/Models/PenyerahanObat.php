<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyerahanObat extends Model
{
    use HasFactory;

    protected $table = 'penyerahan_obats';

    protected $fillable = [
        'pasien_id',
        'pendaftaran_id',
        'nama_obat',
        'dosis',
        'jumlah',
        'aturan_pakai',
        'harga_satuan',
        'total_harga',
        'petugas',
        'tanggal_penyerahan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}