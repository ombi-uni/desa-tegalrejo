<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Resmi Desa Tegalrejo - Kec. Tengaran')</title>
    <meta name="description" content="Website Resmi Desa Tegalrejo, Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Informasi publik, portal berita, transparansi APBDES, dan galeri UMKM desa.">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN for instant presentation & styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brokenwhite: '#FAF9F6',
                        lightblue: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.app.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-brokenwhite text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-lightblue-200 selection:text-lightblue-900">

    <!-- Header Navigation -->
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Title -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-lightblue-600 to-lightblue-400 flex items-center justify-center text-white font-bold text-xl shadow-md shadow-lightblue-500/20 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-tree-city"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-bold text-slate-900 leading-tight tracking-tight">Desa Tegalrejo</span>
                        <span class="block text-xs font-medium text-lightblue-600">Kec. Tengaran, Kab. Semarang</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profile') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('profile') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Profil Desa
                    </a>
                    <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('news.*') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Portal Berita
                    </a>
                    <a href="{{ route('umkm.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors relative {{ request()->routeIs('umkm.index') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <span>Belanja UMKM</span>
                        <span class="absolute -top-1 -right-1 bg-amber-400 text-slate-900 font-bold text-[10px] px-1.5 py-0.5 rounded-full uppercase tracking-wider">Hot</span>
                    </a>
                    <a href="{{ route('budget.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('budget.index') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Transparansi
                    </a>
                </nav>

                <!-- Admin Action Button -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="/admin" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-lightblue-600 hover:bg-lightblue-700 active:scale-95 transition-all shadow-md shadow-lightblue-600/20">
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Beranda</a>
            <a href="{{ route('profile') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Profil Desa</a>
            <a href="{{ route('news.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Portal Berita</a>
            <a href="{{ route('umkm.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Belanja UMKM</a>
            <a href="{{ route('budget.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Transparansi Anggaran</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="/admin" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-base font-semibold text-white bg-lightblue-600 hover:bg-lightblue-700">
                    <i class="fa-solid fa-lock"></i>
                    <span>Dashboard Admin</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <!-- Info Desa -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-lightblue-500 flex items-center justify-center text-white font-bold text-lg">
                            <i class="fa-solid fa-tree-city"></i>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">Desa Tegalrejo</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        Website Resmi Desa Tegalrejo, Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Dikembangkan dalam rangka Digitalisasi Desa dan Pendampingan UMKM bersama Mahasiswa KKN.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-lightblue-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-lightblue-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-lightblue-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-youtube text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-lightblue-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-whatsapp text-sm"></i></a>
                    </div>
                </div>

                <!-- Tautan Cepat -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-lightblue-400">Navigasi Utama</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-lightblue-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:text-lightblue-400 transition-colors">Profil & Perangkat Desa</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-lightblue-400 transition-colors">Portal Berita Terbaru</a></li>
                        <li><a href="{{ route('umkm.index') }}" class="hover:text-lightblue-400 transition-colors">Katalog Belanja UMKM</a></li>
                        <li><a href="{{ route('budget.index') }}" class="hover:text-lightblue-400 transition-colors">Transparansi Anggaran</a></li>
                    </ul>
                </div>

                <!-- Kontak Kantor Desa -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-lightblue-400">Kantor Balai Desa</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-lightblue-400 mt-1"></i>
                            <span>Jl. Raya Tegalrejo No. 01, Kec. Tengaran, Kab. Semarang, Jawa Tengah 50775</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-lightblue-400"></i>
                            <span>pemdes@tegalrejo.desa.id</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-lightblue-400"></i>
                            <span>(0298) 123-4567</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} Pemerintah Desa Tegalrejo. Hak Cipta Dilindungi Undang-Undang.</p>
                <p>Program Kerja KKN Mahasiswa Sistem Informasi &bull; Desa Digital Tegalrejo</p>
            </div>
        </div>
    </footer>

</body>
</html>
