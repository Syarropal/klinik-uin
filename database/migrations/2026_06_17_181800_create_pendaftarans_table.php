<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')
                  ->constrained('pasiens')
                  ->cascadeOnDelete();

            $table->integer('no_antrian')->nullable();

            $table->dateTime('tgl_daftar');

            $table->text('keluhan_awal');

            $table->enum('status', [
                'Menunggu Pemeriksaan',
                'Diperiksa',
                'Menunggu Obat',
                'Selesai'
            ])->default('Menunggu Pemeriksaan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};