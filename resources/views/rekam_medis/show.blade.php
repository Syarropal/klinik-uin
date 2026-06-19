<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Medis: {{ $pasien->nama_pasien }}</title>
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
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <a href="/rekam-medis" class="hover:text-emerald-600 transition">Rekam Medis</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
                <span class="text-slate-700">Detail Riwayat Pasien</span>
            </div>
            <a href="{{ route('rekam-medis.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold px-4 py-2 rounded-lg border border-slate-200 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pasien
            </a>
        </header>

        <div class="p-8 space-y-6">

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-mono font-bold">
                            NIM / NIP: {{ $pasien->nim_nip ?? '-' }}
                        </span>
                        <h2 class="text-base font-black text-slate-800 mt-1">
                            {{ $pasien->nama_pasien }}
                        </h2>
                        <p class="text-xs text-slate-400 font-medium">Pasien Klinik Kampus</p>
                    </div>
                </div>
                <div class="text-left sm:text-right shrink-0">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Kunjungan Periksa</p>
                    <p class="text-2xl font-black text-slate-800">{{ $riwayatMedis->count() }} Kali</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                
                <div class="p-4 bg-slate-900 text-white flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-emerald-400 text-xs"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider">Daftar Riwayat Sakit & Pengobatan Masa Lalu</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3.5 px-4 w-12 text-center">No</th>
                                <th class="py-3.5 px-4 w-32">Tanggal Periksa</th>
                                <th class="py-3.5 px-4 w-56">Keluhan Masuk</th>
                                <th class="py-3.5 px-4 w-52">Diagnosa Dokter</th>
                                <th class="py-3.5 px-4 w-44">Tindakan Medis</th>
                                <th class="py-3.5 px-4">Catatan / Resep Obat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse($riwayatMedis as $index => $rm)
                            <tr class="hover:bg-slate-50/50 transition items-start">
                                <td class="py-3.5 px-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3.5 px-4 font-semibold text-slate-600">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-regular fa-calendar text-[11px] text-slate-400"></i>
                                        {{ $rm->tgl_periksa ? \Carbon\Carbon::parse($rm->tgl_periksa)->format('d-m-Y') : $rm->created_at->format('d-m-Y') }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-slate-600 italic">"{{ $rm->keluhan ?? '-' }}"</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-block bg-rose-50 border border-rose-200 text-rose-700 font-bold px-2.5 py-1 rounded-lg text-[11px]">
                                        <i class="fa-solid fa-triangle-exclamation text-[10px] mr-1"></i>{{ $rm->diagnosa }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 font-medium text-slate-700">{{ $rm->tindakan ?? '-' }}</td>
                                <td class="py-3.5 px-4">
                                    <div class="p-2.5 bg-amber-50/60 border border-amber-200 text-amber-900 rounded-xl font-medium leading-relaxed max-w-xs">
                                        <i class="fa-solid fa-pills text-[10px] text-amber-600 mr-1"></i>
                                        {{ $rm->catatan ?? '-' }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-xs text-slate-400">
                                    <i class="fa-solid fa-notes-medical block text-2xl mb-2 text-slate-300"></i> 
                                    Pasien ini belum memiliki riwayat pemeriksaan medis sebelumnya di klinik.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>