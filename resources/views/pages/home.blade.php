@extends('layouts.app')

@section('title', 'Beranda - Website Resmi Desa Tegalrejo')

@section('content')
<!-- Hero Banner Carousel Section -->
@php
    $bannerList = $banners->count() > 0 ? $banners : collect([
        (object)[
            'image_url' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80',
            'badge_text' => 'Portal Resmi Desa Tegalrejo',
            'title' => 'Selamat Datang di Website Resmi Desa Tegalrejo',
            'subtitle' => 'Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Pusat informasi publik, keterbukaan anggaran, dan katalog digital UMKM desa.',
            'button_text' => 'Lihat Produk UMKM',
            'button_link' => route('umkm.index'),
            'button_secondary_text' => 'Profil & Perangkat Desa',
            'button_secondary_link' => route('profile'),
        ]
    ]);
@endphp

<section x-data="{
    active: 0,
    total: {{ $bannerList->count() }},
    timer: null,
    startAutoSlide() {
        if (this.total > 1) {
            // PENGATURAN DURASI SLIDER: Ubah angka 6500 (milidetik) di bawah sesuai kebutuhan (misal 5000 = 5 detik, 8000 = 8 detik)
            this.timer = setInterval(() => {
                this.next();
            }, 6500);
        }
    },
    stopAutoSlide() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },
    next() {
        this.active = (this.active + 1) % this.total;
    },
    prev() {
        this.active = (this.active - 1 + this.total) % this.total;
    },
    goTo(index) {
        this.active = index;
    }
}" 
x-init="startAutoSlide()" 
@mouseenter="stopAutoSlide()" 
@mouseleave="startAutoSlide()" 
class="relative bg-slate-950 text-white overflow-hidden min-h-[560px] lg:min-h-[640px] flex items-center">

    @foreach($bannerList as $index => $banner)
    <div x-show="active === {{ $index }}"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 scale-105"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute inset-0 z-0">
        <!-- Background Hero Image -->
        <img src="{{ $banner->image_url ?? 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80' }}" 
             alt="{{ $banner->title ?? 'Desa Tegalrejo' }}" 
             class="w-full h-full object-cover opacity-45 mix-blend-overlay">
        <!-- Gradient Overlay for Optimal Text Contrast -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/85 to-slate-900/40"></div>
    </div>
    @endforeach

    <!-- Banner Content Overlay -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 w-full">
        <div class="grid grid-cols-1 grid-rows-1 [&>*]:col-start-1 [&>*]:row-start-1 items-center">
            @foreach($bannerList as $index => $banner)
            <div x-show="active === {{ $index }}"
                 x-cloak
                 x-transition:enter="transition ease-out duration-700 delay-100"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="max-w-3xl space-y-6">

                <!-- Title -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">
                    {{ $banner->title ?? 'Selamat Datang di Website Resmi Desa Tegalrejo' }}
                </h1>

                <!-- Subtitle -->
                @if(!empty($banner->subtitle))
                <p class="text-base sm:text-xl text-slate-300 font-normal leading-relaxed">
                    {{ $banner->subtitle }}
                </p>
                @endif

                <!-- Action Buttons (Configured by Admin) -->
                <div class="pt-4 flex flex-wrap gap-4 items-center">
                    @if(!empty($banner->button_text))
                    <a href="{{ $banner->button_link ?? route('umkm.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-bold text-white bg-lightblue-600 hover:bg-lightblue-700 active:scale-95 transition-all shadow-lg shadow-lightblue-600/30">
                        <span>{{ $banner->button_text }}</span>
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                    @endif

                    @if(!empty($banner->button_secondary_text))
                    <a href="{{ $banner->button_secondary_link ?? route('profile') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-slate-200 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 active:scale-95 transition-all">
                        <span>{{ $banner->button_secondary_text }}</span>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Navigation Arrows & Slide Indicators (Only when more than 1 banner) -->
    @if($bannerList->count() > 1)
    <!-- Prev Arrow Button -->
    <button @click="prev()" type="button" aria-label="Banner Sebelumnya" class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-lightblue-600 text-white backdrop-blur-md border border-white/10 flex items-center justify-center transition-all group shadow-lg">
        <i class="fa-solid fa-chevron-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
    </button>

    <!-- Next Arrow Button -->
    <button @click="next()" type="button" aria-label="Banner Selanjutnya" class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-lightblue-600 text-white backdrop-blur-md border border-white/10 flex items-center justify-center transition-all group shadow-lg">
        <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform"></i>
    </button>

    <!-- Indicators Bar at Bottom -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2.5 bg-slate-950/40 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
        @foreach($bannerList as $index => $banner)
        <button @click="goTo({{ $index }})" 
                type="button" 
                :aria-label="'Pindah ke banner ' + ({{ $index }} + 1)"
                class="transition-all duration-300 rounded-full h-2.5"
                :class="active === {{ $index }} ? 'w-8 bg-lightblue-500 shadow-md shadow-lightblue-500/50' : 'w-2.5 bg-white/40 hover:bg-white/70'">
        </button>
        @endforeach
    </div>
    @endif
</section>

<!-- Statistik Desa Counter Section -->
<section class="py-16 lg:py-20 bg-brokenwhite border-b border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            <!-- Counter 1: Penduduk -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-lightblue-300 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-lightblue-50 text-lightblue-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($statistic->population_count ?? 4850) }}
                </div>
                <div class="text-sm font-medium text-slate-500 mt-1">Jumlah Penduduk (Jiwa)</div>
            </div>

            <!-- Counter 2: Bangunan -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-lightblue-300 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-house-chimney"></i>
                </div>
                <div class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($statistic->building_count ?? 1240) }}
                </div>
                <div class="text-sm font-medium text-slate-500 mt-1">Jumlah Bangunan</div>
            </div>

            <!-- Counter 3: Fasilitas Umum -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-lightblue-300 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($statistic->facility_count ?? 18) }}
                </div>
                <div class="text-sm font-medium text-slate-500 mt-1">Fasilitas Umum (Makam, Lapangan, dll)</div>
            </div>

            <!-- Counter 4: Tempat Ibadah -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-lightblue-300 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($statistic->worship_place_count ?? 14) }}
                </div>
                <div class="text-sm font-medium text-slate-500 mt-1">Tempat Ibadah</div>
            </div>
        </div>
    </div>
</section>

<!-- Video Profil Desa Section -->
<section class="py-16 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 space-y-6">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $profile->video_title ?? 'Video Profil Desa Tegalrejo' }}
                </h2>
                <p class="text-slate-600 leading-relaxed">
                    {{ $profile->video_description ?? 'Saksikan keindahan alam, kehidupan masyarakat yang kental akan kebersamaan, serta geliat ekonomi UMKM lokal Desa Tegalrejo, Kecamatan Tengaran, Kabupaten Semarang.' }}
                </p>
                <div class="pt-2">
                    <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 font-bold text-lightblue-600 hover:text-lightblue-700 transition-colors">
                        <span>Baca Selengkapnya Profil Desa</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="relative aspect-video rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-900 group">
                    <iframe class="w-full h-full" src="{{ $profile->youtube_embed_url }}" title="Video Profil Desa Tegalrejo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Highlight UMKM Unggulan Section -->
<section class="py-20 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Katalog UMKM Desa Tegalrejo</h2>
                <p class="text-slate-500 mt-1 max-w-xl">Produk lokal berkualitas hasil pendampingan NIB, PIRT, Sertifikat Halal, dan Toko Digital.</p>
            </div>
            <a href="{{ route('umkm.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-lightblue-600 bg-white border border-lightblue-200 hover:bg-lightblue-50 transition-all shadow-sm">
                <span>Lihat Semua UMKM</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredUmkms as $umkm)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="{{ $umkm->image_url }}" alt="{{ $umkm->store_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md text-slate-800 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                            {{ $umkm->category }}
                        </div>
                    </div>
                    <div class="p-5 space-y-2">
                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-lightblue-600 transition-colors line-clamp-1">
                            {{ $umkm->store_name }}
                        </h3>
                        <p class="text-xs text-slate-400 font-medium">Pemilik: {{ $umkm->owner_name }}</p>
                        <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">
                            {{ $umkm->description }}
                        </p>

                        <!-- Badges Sertifikasi -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            @if($umkm->has_nib)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold px-2 py-0.5 rounded-full"><i class="fa-solid fa-check text-[9px]"></i> NIB</span>
                            @endif
                            @if($umkm->has_pirt)
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold px-2 py-0.5 rounded-full"><i class="fa-solid fa-check text-[9px]"></i> PIRT</span>
                            @endif
                            @if($umkm->has_halal)
                                <span class="bg-teal-50 text-teal-700 border border-teal-200 text-[10px] font-bold px-2 py-0.5 rounded-full"><i class="fa-solid fa-check text-[9px]"></i> Halal</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0 flex items-center justify-between gap-2 border-t border-slate-50 mt-4">
                    <span class="text-xs font-bold text-slate-900">{{ $umkm->price_range ?? 'Hubungi WA' }}</span>
                    <a href="https://wa.me/{{ $umkm->whatsapp_number }}?text=Halo%20{{ urlencode($umkm->store_name) }},%20saya%20tertarik%20memesan%20produk%20via%20Website%20Desa%20Tegalrejo." target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Pesan</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight">Berita & Kegiatan Desa</h2>
                <p class="text-slate-500 mt-1 max-w-xl">Kumpulan artikel berita dan agenda kegiatan terbaru Desa Tegalrejo.</p>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 font-bold text-lightblue-600 hover:text-lightblue-700 transition-colors">
                <span>Lihat Semua Berita</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $item)
            <article class="bg-brokenwhite rounded-2xl overflow-hidden border border-slate-100 shadow-md hover:shadow-lg transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-lightblue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $item->category }}
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-3 text-xs text-slate-400">
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ optional($item->published_at)->format('d M Y') ?? 'Terbaru' }}</span>
                            <span>&bull;</span>
                            <span><i class="fa-regular fa-user mr-1"></i> {{ $item->author }}</span>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-lightblue-600 transition-colors line-clamp-2">
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <div class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                            {!! strip_tags($item->content) !!}
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-lightblue-600 hover:text-lightblue-700">
                        <span>Baca Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
