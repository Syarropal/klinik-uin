<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Pasien - Klinik Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans min-h-screen flex" x-data="{ openModal: false }">

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

                <a href="/pasien" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm transition">
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
            <h1 class="text-sm font-bold text-slate-700">Data Pasien (CRUD) - Klinik Kampus</h1>
            <div class="text-xs text-slate-400">Edisi Proyek 2026</div>
        </header>

        <div class="p-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-500"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                
                <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-address-card text-slate-500 text-xs"></i>
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Pasien Terregistrasi</h2>
                    </div>
                    <button type="button" @click="openModal = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition shadow-md shadow-blue-100 flex items-center gap-1.5">
                        <i class="fa-solid fa-user-plus text-[10px]"></i> Tambah Pasien Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4 w-12 text-center">No</th>
                                <th class="py-3 px-4 w-32">NIM / NIP</th>
                                <th class="py-3 px-4">Nama Pasien</th>
                                <th class="py-3 px-4 w-16 text-center">L/P</th>
                                <th class="py-3 px-4 w-40">No. HP</th>
                                <th class="py-3 px-4">Alamat</th>
                                <th class="py-3 px-4 w-24 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse($pasiens as $index => $p)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">
                                    <span class="bg-slate-100 text-slate-700 font-mono font-semibold px-2 py-0.5 rounded text-[10px] border border-slate-200">
                                        {{ $p->nim_nip }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 font-semibold text-slate-900">{{ $p->nama_pasien }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="font-bold {{ $p->jenis_kelamin == 'L' ? 'text-blue-600' : 'text-pink-600' }}">
                                        {{ $p->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 font-mono">{{ $p->no_hp }}</td>
                                <td class="py-3 px-4 text-slate-500 max-w-xs truncate" title="{{ $p->alamat }}">{{ $p->alamat }}</td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pasien {{ $p->nama_pasien }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-[10px] font-bold px-2.5 py-1 rounded border border-red-200 transition inline-flex items-center gap-1">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-xs text-slate-400">
                                    <i class="fa-solid fa-folder-open block text-lg mb-2 text-slate-300"></i> Belum ada data pasien di database.
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

    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-transition.opacity>
        
        <div @click.away="openModal = false" class="bg-white w-full max-w-md rounded-xl border border-slate-200 shadow-2xl overflow-hidden" x-transition.scale.95>
            
            <div class="p-4 bg-blue-600 text-white flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-id-card"></i> Form Tambah Pasien Baru
                </h3>
                <button @click="openModal = false" class="text-white/80 hover:text-white transition text-lg">&times;</button>
            </div>

            <form action="{{ route('pasien.store') }}" method="POST" class="p-5 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">NIM / NIP</label>
                    <input type="text" name="nim_nip" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition"
                        placeholder="Contoh: 701240191">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap Pasien</label>
                    <input type="text" name="nama_pasien" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition"
                        placeholder="Masukkan nama lengkap pasien">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition text-slate-700">
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition text-slate-600">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">No. Handphone</label>
                    <input type="text" name="no_hp" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition"
                        placeholder="Contoh: 081234567890">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition placeholder-slate-400"
                        placeholder="Alamat tempat tinggal saat ini..."></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" @click="openModal = false"
                        class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-700 border border-slate-200 rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-md shadow-blue-100 flex items-center gap-1.5">
                        <i class="fa-solid fa-save text-[11px]"></i> Simpan Data Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>