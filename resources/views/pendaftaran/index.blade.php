<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Antrean Pasien - Klinik Kampus</title>
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
                
                <a href="/pendaftaran" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm transition">
                    <i class="fa-solid fa-clipboard-list w-5 text-center"></i>
                    <span>Pendaftaran Antrean Pasien</span>
                </a>
                
                <a href="/admin/users" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
                    <i class="fa-solid fa-user-doctor w-5 text-center"></i>
                    <span>Kelola Dokter & Apoteker</span>
                </a>
                
                <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white font-medium text-sm transition text-slate-400">
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
            <h1 class="text-sm font-bold text-slate-700">Pendaftaran Antrean Pasien - Klinik Kampus</h1>
            <div class="text-xs text-slate-400">Edisi Proyek 2026</div>
        </header>

        <div class="p-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-500"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm h-fit">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                        <i class="fa-solid fa-square-plus text-emerald-600 text-xs"></i>
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Antrean Hari Ini</h2>
                    </div>

                    <form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Pilih Pasien</label>
                            <select name="id_pasien" required
                                class="w-full px-3 py-2 text-xs border border-slate-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition text-slate-700">
                                <option value="" disabled selected>-- Cari Nama Pasien --</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}">
                                        {{ $pasien->nim_nip }} - {{ $pasien->nama_pasien }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Keluhan Awal</label>
                            <input type="text" name="keluhan_awal" required
                                class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition"
                                placeholder="Contoh: Demam tinggi, Pusing">
                        </div>

                        <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold py-2.5 rounded-lg transition shadow-md shadow-emerald-100 flex items-center justify-center gap-2 mt-2">
                            <i class="fa-solid fa-paper-plane"></i> Masukkan Antrean
                        </button>
                    </form>
                </div>

                <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden h-fit">
                    <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center gap-2">
                        <i class="fa-solid fa-list-ol text-slate-500 text-xs"></i>
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Antrean Hari Ini</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="py-3 px-4 w-24 text-center">No Antrean</th>
                                    <th class="py-3 px-4">NIM / NIP</th>
                                    <th class="py-3 px-4">Nama Pasien</th>
                                    <th class="py-3 px-4">Keluhan Awal</th>
                                    <th class="py-3 px-4 w-44 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse($pendaftarans as $p)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-3 px-4 text-center">
                                        <span class="inline-block bg-blue-600 text-white font-bold text-xs px-2.5 py-1 rounded-lg shadow-sm">
                                            {{ $p->no_antrian }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 font-mono text-slate-500">{{ $p->pasien?->nim_nip ?? '-' }}</td>
                                    <td class="py-3 px-4 font-semibold text-slate-900">{{ $p->pasien?->nama_pasien ?? '-' }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ $p->keluhan_awal }}</td>
                                    <td class="py-3 px-4 text-center">
                                        @if($p->status == 'Menunggu Pemeriksaan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase">
                                                <i class="fa-solid fa-clock-rotate-left mr-1 text-[8px]"></i> {{ $p->status }}
                                            </span>
                                        @elseif($p->status == 'Menunggu Obat')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200 uppercase">
                                                <i class="fa-solid fa-pills mr-1 text-[8px]"></i> {{ $p->status }}
                                            </span>
                                        @elseif($p->status == 'Selesai')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase">
                                                <i class="fa-solid fa-circle-check mr-1 text-[8px]"></i> {{ $p->status }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200 uppercase">
                                                {{ $p->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-xs text-slate-400">
                                        <i class="fa-solid fa-folder-open block text-lg mb-2 text-slate-300"></i> Belum ada antrean masuk hari ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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