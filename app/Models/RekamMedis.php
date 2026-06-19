<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'tgl_periksa',
        'keluhan',
        'diagnosa',
        'tindakan',
        'catatan'
    ];

    // Hubungan ke data pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    // Hubungan ke data resep
    public function resep()
    {
        return $this->hasOne(Resep::class, 'rekam_medis_id');
    }
}