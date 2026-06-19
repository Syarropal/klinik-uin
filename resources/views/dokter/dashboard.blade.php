<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Klinik Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between shadow-xl shrink-0">
        <div>
            <div class="p-5 border-b border-slate-800 flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-sm uppercase tracking-wider leading-tight">Panel Dokter</h2>
                    <p class="text-[10px] text-slate-500 font-medium">UIN STS JAMBI</p>
                </div>
            </div>

            <nav class="px-3 mt-6 space-y-1">
                <a href="/dokter/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-medium text-sm transition">
                    <i class="fa-solid fa-house-medical w-5 text-center"></i>
                    <span>Dashboard Dokter</span>
                </a>

                <a href="/resep" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-prescription-bottle-medical w-5 text-center"></i>
                    <span>Pemeriksaan & Resep</span>
                </a>
                
                <a href="/rekam-medis" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-notes-medical w-5 text-center"></i>
                    <span>Rekap Medis Pasien</span>
                </a>
            </nav>
        </div>

        <div class="p-3 border-t border-slate-800">
            <a href="/logout" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-red-950/40 hover:text-red-400 font-medium text-sm transition text-slate-400">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
            <h1 class="text-sm font-bold text-slate-700">Selamat Datang di Ruang Pemeriksaan</h1>
            <div class="text-xs text-slate-400">Edisi Proyek 2026</div>
        </header>

        <div class="p-8 space-y-6">
            
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6 rounded-2xl text-white shadow-md shadow-emerald-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold">Halo, Dokter! 👋</h2>
                    <p class="text-xs text-emerald-100 mt-1 max-w-xl">
                        Tetap teliti dalam memeriksa gejala mahasiswa dan staf. Pastikan riwayat rekam medis diperiksa sebelum memberikan resep obat baru.
                    </p>
                </div>
                <i class="fa-solid fa-heart-pulse text-5xl text-emerald-500/40 hidden sm:block mr-4"></i>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-800">Pemeriksaan & Resep Obat</h3>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Tangani antrean pasien hari ini, input gejala, diagnosa penyakit, dan racik resep obat langsung ke sistem apoteker.
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-user-injured"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/resep" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2 shadow-sm shadow-emerald-50">
                            <span>Buka Antrean Pasien</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-800">Rekap Medis Pasien</h3>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Cari data rekam medis pasien untuk melihat riwayat penyakit, alergi, dan resep obat yang pernah diterima sebelumnya.
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/rekam-medis" class="w-full bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2">
                            <span>Lihat Riwayat Penyakit</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>