<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Pemeriksaan & Resep - Dokter</title>
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

                <a href="/resep" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-medium text-sm transition">
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
            <h1 class="text-sm font-bold text-slate-700">Ruang Periksa Dokter & Pembuatan Resep</h1>
            <a href="/dokter/dashboard" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold px-4 py-2 rounded-lg border border-slate-200 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </header>

        <div class="p-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-base text-emerald-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-4 bg-slate-900 text-white flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-user text-emerald-400 text-sm"></i>
                        <h5 class="text-xs font-bold uppercase tracking-wider">Antrean Pasien Hari Ini</h5>
                    </div>

                    <ul class="divide-y divide-slate-100">
                        @forelse($antreanPasien as $p)
                            <li class="p-4 hover:bg-slate-50/80 transition flex items-start justify-between gap-3">
                                <div class="space-y-1">
                                    <span class="inline-block bg-emerald-100 text-emerald-800 text-[10px] font-black px-2 py-0.5 rounded-md">
                                        No. {{ $p->no_antrian }}
                                    </span>
                                    <h4 class="text-xs font-bold text-slate-800 block pt-1">
                                        {{ $p->pasien?->nama_pasien ?? 'Pasien Tanpa Nama' }}
                                    </h4>
                                    <p class="text-[11px] text-slate-400 italic">
                                        Keluhan: "{{ $p->keluhan_awal ?? '-' }}"
                                    </p>
                                </div>
                                <button type="button"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition shrink-0 flex items-center gap-1 shadow-sm"
                                    onclick="pilihPasien(
                                        '{{ $p->id }}',
                                        '{{ $p->pasien_id }}',
                                        '{{ addslashes($p->pasien?->nama_pasien ?? 'Tanpa Nama') }}',
                                        '{{ $p->no_antrian }}'
                                    )">
                                    <i class="fa-solid fa-stethoscope text-[10px]"></i> Periksa
                                </button>
                            </li>
                        @empty
                            <li class="p-8 text-center text-xs text-slate-400">
                                <i class="fa-solid fa-users-slash block text-xl mb-2 text-slate-300"></i> Tidak ada antrean pasien saat ini.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-4 bg-rose-600 text-white flex items-center gap-2">
                        <i class="fa-solid fa-file-medical text-sm"></i>
                        <h5 class="text-xs font-bold uppercase tracking-wider">Input Diagnosa & Resep Obat Baru</h5>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('resep.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <input type="hidden" name="pendaftaran_id" id="pendaftaran_id">
                            <input type="hidden" name="pasien_id" id="pasien_id">

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="sm:col-span-1">
                                    <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1">Nomor Antrean</label>
                                    <input type="text" id="no_antrian_display" readonly
                                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 font-bold text-slate-500 outline-none">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1">Nama Pasien Terpilih</label>
                                    <input type="text" id="nama_pasien_display" readonly placeholder="Klik tombol Periksa di sebelah kiri"
                                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl bg-slate-50 font-semibold text-slate-800 placeholder-slate-400 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1">Diagnosa Penyakit <span class="text-rose-500">*</span></label>
                                <input type="text" name="diagnosa" required placeholder="Contoh: Infeksi Saluran Pernapasan Akut (ISPA)"
                                    class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-600 outline-none text-slate-700 transition">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1">Tindakan Medis (Opsional)</label>
                                <input type="text" name="tindakan" placeholder="Contoh: Pemberian kompres hangat / Nebulizer"
                                    class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-600 outline-none text-slate-700 transition">
                            </div>

                            <hr class="border-slate-100 my-2">

                            <div class="bg-rose-50/50 p-4 rounded-xl border border-rose-100 space-y-4">
                                <div class="flex items-center gap-1.5 text-rose-700">
                                    <i class="fa-solid fa-pills text-xs"></i>
                                    <h5 class="text-xs font-bold uppercase tracking-wider">Tulis Resep Obat (Untuk Apoteker)</h5>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-rose-900 uppercase tracking-wide mb-1">Nama Obat <span class="text-rose-500">*</span></label>
                                    <input type="text" name="nama_obat" required placeholder="Contoh: Paracetamol 500mg / Amoxicillin"
                                        class="w-full px-3 py-2 text-xs border border-rose-200 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none bg-white text-slate-700 transition">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="sm:col-span-2">
                                        <label class="block text-[10px] font-bold text-rose-900 uppercase tracking-wide mb-1">Aturan Pakai / Dosis <span class="text-rose-500">*</span></label>
                                        <input type="text" name="dosis" required placeholder="Contoh: 3 x 1 Sehari Sesudah Makan"
                                            class="w-full px-3 py-2 text-xs border border-rose-200 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none bg-white text-slate-700 transition">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label class="block text-[10px] font-bold text-rose-900 uppercase tracking-wide mb-1">Jumlah <span class="text-rose-500">*</span></label>
                                        <input type="number" name="jumlah" min="1" required placeholder="0"
                                            class="w-full px-3 py-2 text-xs border border-rose-200 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none bg-white text-slate-700 transition">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-3 px-4 rounded-xl transition shadow-md shadow-rose-100 flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-paper-plane text-[11px]"></i> Kirim Resep ke Apoteker
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script>
    function pilihPasien(pendaftaranId, pasienId, namaPasien, noAntrean) {
        document.getElementById('pendaftaran_id').value = pendaftaranId;
        document.getElementById('pasien_id').value = pasienId;
        document.getElementById('nama_pasien_display').value = namaPasien;
        document.getElementById('no_antrian_display').value = 'No. ' + noAntrean;
    }
    </script>

</body>
</html>