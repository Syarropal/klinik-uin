<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'reseps'; 

    // Diselaraskan dengan kolom database fisik kamu yang aslinya saja
    protected $fillable = [
        'rekam_medis_id',
        'dokter_id',
        'tanggal_resep'
    ];

    // Relasi ke Rekam Medis
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_medis_id');
    }
}