<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apoteker - Klinik UIN STS Jambi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between shadow-xl shrink-0">
        <div>
            <div class="p-5 border-b border-slate-800 flex items-center gap-3">
                <div class="w-9 h-9 bg-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    <i class="fa-solid fa-prescription-bottle-medical"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-sm uppercase tracking-wider leading-tight">Apotek Klinik</h2>
                    <p class="text-[10px] text-slate-500 font-medium">UIN STS JAMBI</p>
                </div>
            </div>

            <nav class="px-3 mt-6 space-y-1">
                <button onclick="switchTab('resep-masuk')" id="btn-resep-masuk" 
                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition text-left bg-teal-600 text-white shadow-md shadow-teal-900/20">
                    <i class="fa-solid fa-file-medical w-5 text-center"></i>
                    <span>Resep Masuk</span>
                </button>

                <button onclick="switchTab('penyerahan-obat')" id="btn-penyerahan-obat" 
                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition text-left text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-hand-holding-medical w-5 text-center"></i>
                    <span>Penyerahan Obat</span>
                </button>
            </nav>
        </div>

        <div class="p-3 border-t border-slate-800">
            <form action="/logout" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-red-950/40 hover:text-red-400 font-medium text-sm transition text-slate-400 text-left">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
            <div>
                <h1 class="text-sm font-bold text-slate-800">Dashboard Manajemen Farmasi</h1>
                <p class="text-[11px] text-slate-400 font-medium">Selamat Datang, Petugas Apotek Klinik Kampus</p>
            </div>
            <div class="bg-teal-50 border border-teal-200 text-teal-800 text-xs font-bold px-3 py-1.5 rounded-xl shadow-sm">
                <i class="fa-regular fa-calendar-days mr-1"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>
        </header>

        <div class="p-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm animate-pulse">
                    <i class="fa-solid fa-circle-check text-sm text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div id="content-resep-masuk" class="tab-content block">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    
                    <div class="p-4 bg-slate-900 text-white flex items-center gap-2">
                        <i class="fa-solid fa-tray-received text-teal-400 text-xs"></i>
                        <h2 class="text-xs font-bold uppercase tracking-wider">Daftar Resep Masuk (Menunggu Penyiapan)</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="py-3.5 px-4 w-24 text-center">No Antrean</th>
                                    <th class="py-3.5 px-4 w-36">NIM / NIP</th>
                                    <th class="py-3.5 px-4 w-48">Nama Pasien</th>
                                    <th class="py-3.5 px-4">Keluhan Awal</th>
                                    <th class="py-3.5 px-4 w-64">Instruksi Resep Dokter</th>
                                    <th class="py-3.5 px-4 w-32 text-center">Status</th>
                                    <th class="py-3.5 px-4 w-28 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                                @forelse($pasienSelesai as $p)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-3.5 px-4 text-center font-bold text-slate-900 bg-slate-50/30">
                                        <span class="bg-slate-200 px-2 py-0.5 rounded text-slate-700 font-mono">
                                            {{ $p->no_antrian ?? $p->id }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 font-mono font-semibold text-slate-600">
                                        {{ $p->pasien?->nim_nip ?? '-' }}
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-slate-900">
                                        {{ $p->pasien?->nama_pasien }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-500 italic">
                                        "{{ $p->keluhan_awal }}"
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="p-2 bg-amber-50 border border-amber-200 rounded-lg text-amber-900 text-[11px] font-medium leading-relaxed">
                                            <i class="fa-solid fa-pills text-amber-600 mr-1"></i>
                                            {{ $p->rekamMedis?->catatan ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-800 border border-amber-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                            Menunggu Obat
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <button type="button" onclick="pilihPasienKeForm('{{ $p->id }}')"
                                            class="bg-teal-600 hover:bg-teal-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg border border-teal-700 shadow-sm transition flex items-center justify-center gap-1 mx-auto">
                                            Proses <i class="fa-solid fa-chevron-right text-[9px]"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-12 text-center text-xs text-slate-400">
                                        <i class="fa-solid fa-circle-check block text-2xl mb-2 text-slate-300"></i>
                                        Luar biasa! Antrean resep kosong. Semua kebutuhan obat pasien telah terpenuhi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="content-penyerahan-obat" class="tab-content hidden">
                <div class="max-w-xl mx-auto">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        
                        <div class="p-4 bg-teal-600 text-white flex items-center gap-2">
                            <i class="fa-solid fa-capsules text-white text-xs"></i>
                            <h2 class="text-xs font-bold uppercase tracking-wider">Form Input & Penyerahan Obat Ke Pasien</h2>
                        </div>

                        <div class="p-6">
                            <form action="{{ route('apoteker.store') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Pasien Penerima</label>
                                    <select name="pendaftaran_id" id="pendaftaran_id_select" required
                                        class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition bg-slate-50 font-medium">
                                        <option value="">-- Pilih Antrean Pasien --</option>
                                        @foreach($pasienSelesai as $p)
                                            <option value="{{ $p->id }}">
                                                Antrean #{{ $p->no_antrian ?? $p->id }} - {{ $p->pasien?->nama_pasien }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Obat</label>
                                        <input type="text" name="nama_obat" required placeholder="Contoh: Paracetamol 500mg"
                                            class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Dosis / Aturan Takaran</label>
                                        <input type="text" name="dosis" required placeholder="Contoh: 3 x 1 Sesudah Makan"
                                            class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jumlah Item (Qty)</label>
                                        <input type="number" name="jumlah" min="1" required placeholder="0"
                                            class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Harga Satuan (Rp)</label>
                                        <input type="number" name="harga_satuan" min="0" required placeholder="Masukkan angka tanpa titik"
                                            class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Catatan Tambahan Penggunaan Obat (Opsional)</label>
                                    <textarea name="aturan_pakai" rows="2" placeholder="Tulis catatan jika ada instruksi khusus dari apoteker..."
                                        class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-teal-600 outline-none transition resize-none"></textarea>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" 
                                        class="w-full bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold py-2.5 rounded-xl transition shadow-md shadow-teal-100 flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-paper-plane"></i> Simpan & Selesaikan Penyerahan Obat
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        function switchTab(tabName) {
            // Hapus semua tampilan konten tab
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });
            
            // Sembunyikan class aktif dari semua button sidebar
            const btnResep = document.getElementById('btn-resep-masuk');
            const btnPenyerahan = document.getElementById('btn-penyerahan-obat');
            
            btnResep.className = "w-full flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition text-left text-slate-400 hover:bg-slate-800 hover:text-white";
            btnPenyerahan.className = "w-full flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition text-left text-slate-400 hover:bg-slate-800 hover:text-white";

            // Tampilkan tab yang dipilih
            document.getElementById('content-' + tabName).classList.remove('hidden');
            document.getElementById('content-' + tabName).classList.add('block');

            // Aktifkan button yang diklik
            const activeBtn = document.getElementById('btn-' + tabName);
            activeBtn.className = "w-full flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition text-left bg-teal-600 text-white shadow-md shadow-teal-900/20";
        }

        // Fungsi pemicu otomatis dari tabel ke form
        function pilihPasienKeForm(id) {
            // Set value dropdown pasien sesuai ID
            document.getElementById('pendaftaran_id_select').value = id;
            // Alihkan tab ke form penyerahan obat
            switchTab('penyerahan-obat');
        }
    </script>

</body>
</html>