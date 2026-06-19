<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Mengecek apakah tabel users sudah ada
        if (Schema::hasTable('users')) {
            // Mengecek apakah username 'syarropal' sudah ada
            if (!User::where('username', 'syarropal')->exists()) {
                User::create([
                    'nama_lengkap' => 'Syarropal',
                    'username' => 'syarropal', // Ini yang digunakan untuk login
                    'role' => 'admin',
                    'password' => Hash::make('12345'), // Password disamakan dengan data lama
                ]);
            }
        }
    }
}