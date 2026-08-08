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
                    @if(!empty($villageProfile->logo))
                        <img src="{{ asset('storage/' . $villageProfile->logo) }}" alt="Logo {{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}" class="w-11 h-11 object-contain rounded-xl shadow-md group-hover:scale-105 transition-transform">
                    @else
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-lightblue-600 to-lightblue-400 flex items-center justify-center text-white font-bold text-xl shadow-md shadow-lightblue-500/20 group-hover:scale-105 transition-transform">
                            <i class="{{ $villageProfile->logo_icon ?? 'fa-solid fa-tree-city' }}"></i>
                        </div>
                    @endif
                    <div>
                        <span class="block text-lg font-bold text-slate-900 leading-tight tracking-tight">{{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}</span>
                        <span class="block text-xs font-medium text-lightblue-600">{{ $villageProfile->subdistrict ?? 'Kec. Tengaran' }}, {{ $villageProfile->district ?? 'Kab. Semarang' }}</span>
                    </div>
                </a>

                <!-- Desktop Dynamic Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    @if(isset($navItems) && $navItems->count() > 0)
                        @foreach($navItems as $item)
                            @if($item->children && $item->children->count() > 0)
                                <!-- Dropdown Menu Item -->
                                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                                    <button type="button" @click="open = !open" class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                                        <span>{{ $item->title }}</span>
                                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-lightblue-600' : ''"></i>
                                    </button>
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-150"
                                         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                         class="absolute left-0 top-full mt-1 w-56 bg-white rounded-2xl shadow-xl shadow-slate-900/10 border border-slate-100 py-2 z-50">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->url }}" target="{{ $child->target ?? '_self' }}" class="flex items-center justify-between px-4 py-2.5 text-sm text-slate-700 hover:bg-lightblue-50 hover:text-lightblue-600 transition-colors font-medium">
                                                <span>{{ $child->title }}</span>
                                                @if($child->badge)
                                                    <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-lightblue-100 text-lightblue-700">{{ $child->badge }}</span>
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                @php
                                    $cleanUrl = ltrim($item->url, '/');
                                    $isCurrent = request()->is($cleanUrl) || (request()->path() === '/' && ($item->url === '/' || $cleanUrl === ''));
                                @endphp
                                <a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $isCurrent ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                    <span>{{ $item->title }}</span>
                                    @if($item->badge)
                                        <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-lightblue-100 text-lightblue-700">{{ $item->badge }}</span>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    @else
                        <!-- Fallback Navigation -->
                        <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">Beranda</a>
                        <a href="{{ route('profile') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">Profil Desa</a>
                        <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('news.*') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">Portal Berita</a>
                        <a href="{{ route('umkm.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('umkm.index') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">Belanja UMKM</a>
                        <a href="{{ route('budget.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('budget.index') ? 'bg-lightblue-50 text-lightblue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">Transparansi</a>
                    @endif
                </nav>

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
            @if(isset($navItems) && $navItems->count() > 0)
                @foreach($navItems as $item)
                    @if($item->children && $item->children->count() > 0)
                        <div x-data="{ subOpen: false }" class="space-y-1">
                            <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">
                                <span>{{ $item->title }}</span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="subOpen ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="subOpen" class="pl-4 space-y-1 border-l-2 border-slate-100 ml-4">
                                @foreach($item->children as $child)
                                    <a href="{{ $child->url }}" target="{{ $child->target ?? '_self' }}" class="block px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-lightblue-50 hover:text-lightblue-600">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">
                            {{ $item->title }}
                        </a>
                    @endif
                @endforeach
            @else
                <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Beranda</a>
                <a href="{{ route('profile') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Profil Desa</a>
                <a href="{{ route('news.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Portal Berita</a>
                <a href="{{ route('umkm.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Belanja UMKM</a>
                <a href="{{ route('budget.index') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">Transparansi Anggaran</a>
            @endif
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
                        @if(!empty($villageProfile->logo))
                            <img src="{{ asset('storage/' . $villageProfile->logo) }}" alt="Logo {{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}" class="w-10 h-10 object-contain rounded-xl">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-lightblue-500 flex items-center justify-center text-white font-bold text-lg">
                                <i class="{{ $villageProfile->logo_icon ?? 'fa-solid fa-tree-city' }}"></i>
                            </div>
                        @endif
                        <span class="text-xl font-bold text-white tracking-tight">{{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        Website Resmi {{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}, {{ $villageProfile->subdistrict ?? 'Kecamatan Tengaran' }}, {{ $villageProfile->district ?? 'Kabupaten Semarang' }}, Jawa Tengah. Dikembangkan dalam rangka Digitalisasi Desa dan Pendampingan UMKM bersama Mahasiswa KKN.
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
                        @if(isset($navItems) && $navItems->count() > 0)
                            @foreach($navItems as $item)
                                <li><a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}" class="hover:text-lightblue-400 transition-colors">{{ $item->title }}</a></li>
                            @endforeach
                        @else
                            <li><a href="{{ route('home') }}" class="hover:text-lightblue-400 transition-colors">Beranda Utama</a></li>
                            <li><a href="{{ route('profile') }}" class="hover:text-lightblue-400 transition-colors">Profil & Perangkat Desa</a></li>
                            <li><a href="{{ route('news.index') }}" class="hover:text-lightblue-400 transition-colors">Portal Berita Terbaru</a></li>
                            <li><a href="{{ route('umkm.index') }}" class="hover:text-lightblue-400 transition-colors">Katalog Belanja UMKM</a></li>
                            <li><a href="{{ route('budget.index') }}" class="hover:text-lightblue-400 transition-colors">Transparansi Anggaran</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Kontak Kantor Desa -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-lightblue-400">Kantor Balai Desa</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-lightblue-400 mt-1"></i>
                            <span>Jl. Raya Tegalrejo No. 01, {{ $villageProfile->subdistrict ?? 'Kec. Tengaran' }}, {{ $villageProfile->district ?? 'Kab. Semarang' }}, Jawa Tengah 50775</span>
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

            <!-- Footer Bottom Bar with Subtle Admin Login Access -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} Pemerintah {{ $villageProfile->village_name ?? 'Desa Tegalrejo' }}. Hak Cipta Dilindungi.</p>
                
                <div class="flex items-center gap-3">
                    <p>Program Kerja KKN Mahasiswa &bull; Desa Digital</p>
                    <span class="text-slate-700">|</span>
                    <!-- Subtle Admin Login Access -->
                    <a href="/admin" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-slate-200 transition-all border border-slate-700/60 shadow-sm" title="Akses Khusus Pengelola & Perangkat Desa">
                        <i class="fa-solid fa-lock text-[10px] text-lightblue-400"></i>
                        <span>Akses Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
