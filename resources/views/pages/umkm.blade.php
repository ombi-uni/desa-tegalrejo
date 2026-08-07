@extends('layouts.app')

@section('title', 'Katalog Belanja UMKM Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/30 text-xs font-bold uppercase tracking-wider">
            <i class="fa-solid fa-store"></i> Digitalisasi UMKM KKN Desa Tegalrejo
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Katalog Produk & Usaha Lokal</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Dukung perekonomian warga Desa Tegalrejo. Produk berkualitas buatan tangan warga lokal, berizin resmi, dan bisa dipesan langsung via WhatsApp.</p>
    </div>
</section>

<!-- UMKM Showcase Section -->
<section x-data="{ selectedUmkm: null }" class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Search & Filter Category -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/80 shadow-md flex flex-col md:flex-row items-center justify-between gap-4">
            <form action="{{ route('umkm.index') }}" method="GET" class="w-full md:w-auto flex-1 flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama usaha, produk, atau nama pemilik..." class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-lightblue-500 focus:ring-2 focus:ring-lightblue-100 text-sm">
                </div>
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-lightblue-600 hover:bg-lightblue-700 text-white text-sm font-bold transition-colors">
                    Cari UMKM
                </button>
            </form>

            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                <a href="{{ route('umkm.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ !request('category') || request('category') == 'Semua' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua</a>
                <a href="{{ route('umkm.index', ['category' => 'Kuliner']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Kuliner' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Kuliner</a>
                <a href="{{ route('umkm.index', ['category' => 'Kerajinan']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Kerajinan' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Kerajinan</a>
                <a href="{{ route('umkm.index', ['category' => 'Pertanian & Peternakan']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Pertanian & Peternakan' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Pertanian</a>
            </div>
        </div>

        <!-- Products & UMKM Grid -->
        @if($umkms->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($umkms as $item)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="{{ $item->image ?? 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $item->store_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $item->category }}
                        </span>
                    </div>

                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="font-extrabold text-xl text-slate-900 group-hover:text-lightblue-600 transition-colors">
                                {{ $item->store_name }}
                            </h3>
                        </div>
                        
                        <p class="text-xs font-semibold text-slate-500">
                            <i class="fa-solid fa-user-tie text-lightblue-600 mr-1"></i> Pemilik: {{ $item->owner_name }}
                        </p>

                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-xs font-bold text-slate-400 block uppercase">Produk Unggulan</span>
                            <span class="text-sm font-bold text-slate-800">{{ $item->product_name }}</span>
                        </div>

                        <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                            {{ $item->description }}
                        </p>

                        <!-- Legal Badges (NIB, PIRT, Halal) -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            @if($item->has_nib)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1"><i class="fa-solid fa-certificate text-[10px]"></i> NIB Ready</span>
                            @endif
                            @if($item->has_pirt)
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1"><i class="fa-solid fa-utensils text-[10px]"></i> PIRT</span>
                            @endif
                            @if($item->has_halal)
                                <span class="bg-teal-50 text-teal-700 border border-teal-200 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1"><i class="fa-solid fa-check-double text-[10px]"></i> Halal</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                        <div>
                            <span class="text-[11px] text-slate-400 block font-medium">Perkiraan Harga</span>
                            <span class="text-sm font-extrabold text-slate-900">{{ $item->price_range ?? 'Hubungi Penjual' }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($item->google_maps_url)
                            <a href="{{ $item->google_maps_url }}" target="_blank" title="Lihat Lokasi di Google Maps" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-map-location-dot text-sm text-red-500"></i>
                            </a>
                            @endif
                            <a href="https://wa.me/{{ $item->whatsapp_number }}?text=Halo%20{{ urlencode($item->store_name) }},%20saya%20tertarik%20memesan%20{{ urlencode($item->product_name) }}%20via%20Website%20Desa%20Tegalrejo." target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center gap-1.5 shadow-md shadow-emerald-600/20 transition-all">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Pesan WA</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $umkms->links() }}
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-200/80 p-8 space-y-3">
            <i class="fa-solid fa-box-open text-5xl text-slate-300"></i>
            <h3 class="text-xl font-bold text-slate-700">Tidak Ada Produk UMKM Ditemukan</h3>
            <p class="text-sm text-slate-500">Coba pilih kategori lain atau kata kunci pencarian yang berbeda.</p>
        </div>
        @endif

    </div>
</section>
@endsection
