<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Klinik Kampus</title>
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
            <h1 class="text-sm font-bold text-slate-700">Dashboard Admin - Klinik Kampus</h1>
            <div class="text-xs text-slate-400">Edisi Proyek 2026</div>
        </header>

        <div class="p-8 max-w-4xl space-y-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 mb-1">Selamat Datang di Menu Utama Admin</h2>
                <p class="text-xs text-slate-500 mb-6">Silakan pilih menu di bawah atau melalui sidebar untuk mengelola fitur klinik yang aktif.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="/pasien" class="p-4 bg-slate-50 hover:bg-blue-50/50 border border-slate-200 hover:border-blue-300 rounded-xl transition flex items-start gap-4 group">
                        <div class="p-3 bg-white rounded-lg text-slate-400 group-hover:text-blue-600 group-hover:shadow-sm border border-slate-100 transition">
                            <i class="fa-solid fa-users text-lg w-6 text-center"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition">Data Pasien (CRUD)</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Kelola data rekam medis pasien klinik.</p>
                        </div>
                    </a>

                    <a href="/pendaftaran" class="p-4 bg-slate-50 hover:bg-blue-50/50 border border-slate-200 hover:border-blue-300 rounded-xl transition flex items-start gap-4 group">
                        <div class="p-3 bg-white rounded-lg text-slate-400 group-hover:text-blue-600 group-hover:shadow-sm border border-slate-100 transition">
                            <i class="fa-solid fa-clipboard-list text-lg w-6 text-center"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition">Pendaftaran Antrean Pasien</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Input dan atur antrean pasien berobat.</p>
                        </div>
                    </a>

                    <a href="/admin/users" class="p-4 bg-slate-50 hover:bg-blue-50/50 border border-slate-200 hover:border-blue-300 rounded-xl transition flex items-start gap-4 group">
                        <div class="p-3 bg-white rounded-lg text-slate-400 group-hover:text-blue-600 group-hover:shadow-sm border border-slate-100 transition">
                            <i class="fa-solid fa-user-doctor text-lg w-6 text-center"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition">Kelola Dokter & Apoteker</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Manajemen akun staff medis klinik kampus.</p>
                        </div>
                    </a>

                    <a href="/admin/laporan" class="p-4 bg-slate-50 hover:bg-blue-50/50 border border-slate-200 hover:border-blue-300 rounded-xl transition flex items-start gap-4 group">
                        <div class="p-3 bg-white rounded-lg text-slate-400 group-hover:text-blue-600 group-hover:shadow-sm border border-slate-100 transition">
                            <i class="fa-solid fa-file-invoice-dollar text-lg w-6 text-center"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition">Halaman Laporan</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Melihat rekap data laporan klinik.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>