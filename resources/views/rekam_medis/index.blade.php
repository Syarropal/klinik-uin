<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis Pasien - Klinik Kampus</title>
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
                <a href="/dokter/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-house-medical w-5 text-center"></i>
                    <span>Dashboard Dokter</span>
                </a>

                <a href="/resep" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-prescription-bottle-medical w-5 text-center"></i>
                    <span>Pemeriksaan & Resep</span>
                </a>
                
                <a href="/rekam-medis" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-medium text-sm transition">
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
            <h1 class="text-sm font-bold text-slate-700">Data Rekam Medis Pasien - Klinik Kampus</h1>
            <a href="/dokter/dashboard" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold px-4 py-2 rounded-lg border border-slate-200 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </header>

        <div class="p-8 space-y-6">

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <form method="GET" action="" class="flex flex-col sm:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari berdasarkan NIM, NIP, atau Nama Pasien..."
                            class="w-full pl-9 pr-4 py-2 text-xs border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-600 outline-none text-slate-700 transition">
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto shrink-0">
                        <button type="submit" 
                            class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2 rounded-xl transition shadow-md shadow-emerald-100 flex items-center justify-center gap-1.5">
                            Cari Pasien
                        </button>
                        @if(request('search'))
                            <a href="/rekam-medis" 
                                class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold px-4 py-2 rounded-xl border border-slate-200 transition flex items-center justify-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                
                <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-folder-tree text-slate-500 text-xs"></i>
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Master Pasien Klinik</h2>
                    </div>
                    @if(request('search'))
                        <span class="text-[11px] bg-amber-50 border border-amber-200 text-amber-800 font-medium px-2.5 py-0.5 rounded-lg">
                            Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                        </span>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4 w-16 text-center">No</th>
                                <th class="py-3 px-4 w-44">NIM / NIP</th>
                                <th class="py-3 px-4">Nama Lengkap Pasien</th>
                                <th class="py-3 px-4 w-56 text-center">Aksi Pelacakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse($semuaPasien as $index => $pasien)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-mono font-semibold text-slate-600">{{ $pasien->nim_nip ?? '-' }}</td>
                                <td class="py-3 px-4 font-bold text-slate-900">{{ $pasien->nama_pasien }}</td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('rekam-medis.show', $pasien->id) }}" 
                                       class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 hover:text-emerald-800 text-[11px] font-bold px-3 py-1.5 rounded-lg border border-emerald-200 transition">
                                        <i class="fa-solid fa-clock-rotate-left text-[10px]"></i> Lihat Riwayat Penyakit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-xs text-slate-400">
                                    <i class="fa-solid fa-folder-open block text-lg mb-2 text-slate-300"></i> Tidak ditemukan data pasien yang cocok dengan pencarian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pt-2">
                <a href="/dokter/dashboard" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                    &larr; Kembali ke Dashboard Dokter
                </a>
            </div>

        </div>
    </main>

</body>
</html>