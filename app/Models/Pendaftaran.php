<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'pasien_id',
        'no_antrian',
        'tgl_daftar',
        'keluhan_awal',
        'status'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'pendaftaran_id');
    }

    public function penyerahanObat()
    {
        return $this->hasMany(PenyerahanObat::class, 'pendaftaran_id');
    }
}