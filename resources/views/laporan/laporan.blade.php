<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Laporan - Klinik Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between shadow-xl shrink-0">
        <div>
            <div class="p-5 border-b border-slate-800 flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    <i class="fa-solid fa-hospital"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-sm uppercase tracking-wider leading-tight">Klinik Kampus</h2>
                    <p class="text-[10px] text-slate-500 font-medium">UIN STS JAMBI</p>
                </div>
            </div>

            <nav class="px-3 mt-6 space-y-1">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span>Dashboard Admin</span>
                </a>

                <a href="/pasien" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span>Data Pasien (CRUD)</span>
                </a>
                
                <a href="/pendaftaran" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-clipboard-list w-5 text-center"></i>
                    <span>Pendaftaran Antrean Pasien</span>
                </a>
                
                <a href="/admin/users" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-user-doctor w-5 text-center"></i>
                    <span>Kelola Dokter & Apoteker</span>
                </a>
                
                <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm transition">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i>
                    <span>Halaman Laporan</span>
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
            <h1 class="text-sm font-bold text-slate-700">Halaman Laporan Kunjungan & Penyerahan Obat</h1>
            <div class="text-xs text-slate-400">Edisi Proyek 2026</div>
        </header>

        <div class="p-8 space-y-6">

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-100">
                    <i class="fa-solid fa-filter text-blue-600 text-xs"></i>
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Filter Periode Laporan</h2>
                </div>
                
                <form method="GET" action="" class="flex flex-wrap items-end gap-4">
                    <div class="w-full sm:w-44">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" value="{{ request('tgl_mulai') }}"
                            class="w-full px-3 py-1.5 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none text-slate-600 transition">
                    </div>
                    <div class="w-full sm:w-44">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" value="{{ request('tgl_selesai') }}"
                            class="w-full px-3 py-1.5 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none text-slate-600 transition">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow-md shadow-blue-100 flex items-center gap-1.5">
                            <i class="fa-solid fa-magnifying-glass text-[11px]"></i> Filter
                        </button>
                        <a href="/admin/laporan" 
                            class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold px-4 py-2 rounded-lg border border-slate-200 transition flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan Obat</p>
                        <h3 class="text-xl font-black text-emerald-600 mt-0.5">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>
                    </div>
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-sm">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</p>
                        <h3 class="text-xl font-black text-slate-800 mt-0.5">
                            {{ $laporanPasien->count() }} Selesai
                        </h3>
                    </div>
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Lokasi Pemantauan</p>
                        <h3 class="text-xs font-bold text-slate-700 mt-1">Klinik UIN STS Jambi</h3>
                    </div>
                    <div class="w-10 h-10 bg-slate-50 text-slate-500 rounded-lg flex items-center justify-center text-sm">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                
                <div class="p-4 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-slate-500 text-xs"></i>
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Data Riwayat Penyerahan Obat</h2>
                    </div>
                    <div>
                        <button onclick="window.print()" type="button"
                            class="bg-rose-600 hover:bg-rose-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition shadow-md shadow-rose-100 flex items-center gap-1.5">
                            <i class="fa-solid fa-print"></i> Cetak Laporan
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4 w-12 text-center">No</th>
                                <th class="py-3 px-4 text-center">Tgl Penyerahan</th>
                                <th class="py-3 px-4">NIM / NIP</th>
                                <th class="py-3 px-4">Nama Pasien</th>
                                <th class="py-3 px-4">Diagnosa (Rekam Medis)</th>
                                <th class="py-3 px-4 text-right">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse($laporanPasien as $index => $lp)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 text-center font-medium text-slate-400">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-3 px-4 text-center text-slate-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($lp->tanggal_penyerahan)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-4 font-mono text-slate-600">
                                    {{ $lp->pasien->nim_nip ?? '-' }}
                                </td>
                                <td class="py-3 px-4 font-semibold text-slate-900">
                                    {{ $lp->pasien->nama_pasien ?? '-' }}
                                </td>
                                <td class="py-3 px-4 text-slate-500">
                                    <span class="italic">
                                        {{ $lp->pendaftaran->rekamMedis->diagnosa ?? 'Tidak ada diagnosa' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right font-mono font-bold text-emerald-600">
                                    Rp {{ number_format($lp->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-xs text-slate-400">
                                    <i class="fa-solid fa-circle-info block text-lg mb-2 text-slate-300"></i> Belum ada riwayat penyerahan obat yang tercatat pada sistem.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pt-2">
                <a href="/admin/dashboard" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

        </div>
    </main>

</body>
</html>