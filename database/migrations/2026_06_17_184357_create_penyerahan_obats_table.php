<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyerahan_obats', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('pendaftaran_id')->nullable();

            $table->string('nama_obat');
            $table->string('dosis');
            $table->integer('jumlah');
            $table->text('aturan_pakai')->nullable();
            $table->bigInteger('harga_satuan')->default(0);
            $table->bigInteger('total_harga')->default(0);

            $table->string('petugas');
            $table->dateTime('tanggal_penyerahan');

            $table->timestamps();

            $table->foreign('pasien_id')
                ->references('id')
                ->on('pasiens')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyerahan_obats');
    }
};