@extends('layouts.app')

@section('title', $umkm->store_name . ' - UMKM Desa Tegalrejo')

@section('content')
<!-- Header & Breadcrumb -->
<div class="bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-950 text-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-400 font-medium overflow-x-auto whitespace-nowrap pb-2 sm:pb-0">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
            <a href="{{ route('umkm.index') }}" class="hover:text-white transition-colors">Belanja UMKM</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
            <span class="text-lightblue-300 truncate max-w-xs">{{ $umkm->store_name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pt-2">
            <div class="space-y-2 max-w-3xl">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="bg-lightblue-600/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-lightblue-400/30 shadow-sm">
                        <i class="fa-solid fa-tag mr-1 text-[11px]"></i> {{ $umkm->category }}
                    </span>
                    @if($umkm->has_nib)
                    <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-certificate text-[11px]"></i> NIB Resmi
                    </span>
                    @endif
                    @if($umkm->has_halal)
                    <span class="bg-teal-500/20 text-teal-300 border border-teal-500/30 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-moon text-[11px]"></i> Halal MUI/Kemenag
                    </span>
                    @endif
                    @if($umkm->has_pirt)
                    <span class="bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-shield-check text-[11px]"></i> PIRT Terdaftar
                    </span>
                    @endif
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    {{ $umkm->store_name }}
                </h1>
                <p class="text-slate-300 text-sm sm:text-base flex items-center gap-2">
                    <i class="fa-solid fa-user-tie text-lightblue-400"></i>
                    <span>Pemilik Usaha: <strong class="text-white">{{ $umkm->owner_name }}</strong></span>
                </p>
            </div>

            <!-- Price Estimate Badge -->
            @if(!empty($umkm->price_range))
            <div class="bg-white/10 backdrop-blur-md border border-white/15 p-4 sm:p-5 rounded-2xl shrink-0 space-y-1 text-left sm:text-right">
                <div class="text-xs font-semibold text-slate-300">Kisaran Harga Produk</div>
                <div class="text-xl sm:text-2xl font-black text-amber-300 tracking-tight">{{ $umkm->price_range }}</div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Main Detail Content -->
<section x-data="{ previewImage: null }" class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left Column: Image, Gallery, Description, Products (8 cols) -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- Main Store Featured Photo -->
                <div class="bg-white p-3 sm:p-4 rounded-3xl border border-slate-200/80 shadow-md">
                    <div class="relative h-72 sm:h-96 w-full rounded-2xl overflow-hidden bg-slate-100 group">
                        <img src="{{ $umkm->image_url }}" alt="{{ $umkm->store_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-xs uppercase tracking-wider text-slate-300 font-semibold">Produk Unggulan:</span>
                            <div class="text-lg sm:text-xl font-bold drop-shadow-md">{{ $umkm->product_name }}</div>
                        </div>
                    </div>

                    <!-- Photo Gallery (If available) -->
                    @php $gallery = $umkm->gallery_urls; @endphp
                    @if(count($gallery) > 0)
                    <div class="pt-4 space-y-2">
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider px-1">Galeri Foto Produk & Dokumentasi:</div>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($gallery as $imgUrl)
                            <div @click="previewImage = '{{ $imgUrl }}'" class="relative aspect-video rounded-xl overflow-hidden border border-slate-200 cursor-pointer group hover:border-lightblue-500 transition-all">
                                <img src="{{ $imgUrl }}" alt="Foto Produk" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description Card -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-md space-y-4">
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-lightblue-50 text-lightblue-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900">Tentang Usaha & Produk</h2>
                            <p class="text-xs text-slate-500">Profil lengkap dan keunggulan produk dampingan Desa Tegalrejo</p>
                        </div>
                    </div>
                    
                    <div class="text-slate-700 leading-relaxed text-base space-y-4 prose max-w-none">
                        <p>{{ $umkm->description }}</p>
                    </div>

                    @if(!empty($umkm->address))
                    <div class="pt-4 border-t border-slate-100 flex items-start gap-3 text-sm text-slate-600">
                        <i class="fa-solid fa-location-dot text-rose-500 mt-1 text-base shrink-0"></i>
                        <div>
                            <strong class="text-slate-800">Alamat Lengkap:</strong>
                            <p class="mt-0.5">{{ $umkm->address }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- List of Products & Pricing Table -->
                @php $products = $umkm->products_list; @endphp
                @if(!empty($products) && is_array($products) && count($products) > 0)
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-md space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-900">Daftar Produk & Harga</h2>
                                <p class="text-xs text-slate-500">Pilih varian produk yang ingin Anda pesan langsung ke pemilik usaha</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-full self-start sm:self-auto">
                            {{ count($products) }} Varian Tersedia
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($products as $prod)
                        @php
                            $prodName = is_array($prod) ? ($prod['name'] ?? 'Produk') : $prod;
                            $prodPrice = is_array($prod) ? ($prod['price'] ?? '-') : '-';
                            $prodUnit = is_array($prod) ? ($prod['unit'] ?? '') : '';
                            $prodDesc = is_array($prod) ? ($prod['description'] ?? '') : '';
                            $waItemMsg = "Halo {$umkm->store_name}, saya tertarik memesan produk: *{$prodName}* ({$prodPrice}). Apakah stok masih tersedia?";
                            $waItemUrl = "https://wa.me/{$umkm->clean_whatsapp}?text=" . rawurlencode($waItemMsg);
                        @endphp
                        <div class="p-5 rounded-2xl border border-slate-200/80 hover:border-lightblue-300 hover:shadow-md transition-all flex flex-col justify-between space-y-3 bg-slate-50/50">
                            <div class="space-y-1">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-extrabold text-slate-900 text-base leading-snug">{{ $prodName }}</h3>
                                </div>
                                @if(!empty($prodDesc))
                                <p class="text-xs text-slate-500 leading-relaxed">{{ $prodDesc }}</p>
                                @endif
                            </div>

                            <div class="pt-2 flex items-center justify-between border-t border-slate-200/60">
                                <div>
                                    <div class="text-base font-black text-emerald-600 tracking-tight">{{ $prodPrice }}</div>
                                    @if(!empty($prodUnit))
                                    <div class="text-[11px] text-slate-400 font-medium">/ {{ $prodUnit }}</div>
                                    @endif
                                </div>

                                <a href="{{ $waItemUrl }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white text-xs font-bold transition-all shadow-sm">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>Pesan Item</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Google Maps Frame Section -->
                @if(!empty($umkm->google_maps_url))
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-md space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-900">Lokasi Tempat Usaha</h2>
                                <p class="text-xs text-slate-500">Kunjungi langsung toko / lokasi produksi di Desa Tegalrejo</p>
                            </div>
                        </div>

                        <a href="https://maps.google.com/maps?q={{ urlencode($umkm->store_name . ' Desa Tegalrejo') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 text-xs font-bold transition-colors">
                            <i class="fa-solid fa-diamond-turn-right"></i>
                            <span>Buka di Google Maps</span>
                        </a>
                    </div>

                    <!-- Responsive Google Maps Embed -->
                    <div class="relative w-full h-72 sm:h-80 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100">
                        <iframe class="w-full h-full border-0" 
                                src="{{ $umkm->google_maps_embed_url }}" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade" 
                                title="Peta Lokasi {{ $umkm->store_name }}">
                        </iframe>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Instant Purchase & Contact Sidebar (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Direct Order Card -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-lg sticky top-24 space-y-6">
                    <div class="space-y-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-lightblue-600">Pemesanan Langsung</span>
                        <h3 class="text-xl font-extrabold text-slate-900">Beli & Hubungi Penjual</h3>
                        <p class="text-xs text-slate-500">Terhubung langsung tanpa perantara ke pemilik UMKM Desa Tegalrejo.</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <!-- WhatsApp Button (Primary) -->
                        <a href="{{ $umkm->whatsapp_order_url }}" target="_blank" class="w-full flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold text-sm sm:text-base transition-all shadow-lg shadow-emerald-600/30">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                            <span>Chat & Pesan WhatsApp</span>
                        </a>

                        <!-- Shopee Button (If exists) -->
                        @if(!empty($umkm->shopee_url))
                        <a href="{{ $umkm->shopee_url }}" target="_blank" class="w-full flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-[#EE4D2D] hover:bg-[#d63f20] active:scale-95 text-white font-bold text-sm transition-all shadow-md">
                            <i class="fa-solid fa-bag-shopping text-lg"></i>
                            <span>Beli di Shopee</span>
                        </a>
                        @endif

                        <!-- Tokopedia Button (If exists) -->
                        @if(!empty($umkm->tokopedia_url))
                        <a href="{{ $umkm->tokopedia_url }}" target="_blank" class="w-full flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-[#03AC0E] hover:bg-[#028b0b] active:scale-95 text-white font-bold text-sm transition-all shadow-md">
                            <i class="fa-solid fa-store text-lg"></i>
                            <span>Beli di Tokopedia</span>
                        </a>
                        @endif
                    </div>

                    <!-- Security & Direct Guarantee Box -->
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/60 space-y-3 text-xs text-slate-600">
                        <div class="flex items-center gap-2 font-bold text-slate-800">
                            <i class="fa-solid fa-shield-halved text-emerald-600 text-sm"></i>
                            <span>Produk Terverifikasi Desa</span>
                        </div>
                        <ul class="space-y-1.5 list-disc list-inside text-slate-500">
                            <li>Dikelola langsung oleh warga Desa Tegalrejo</li>
                            <li>Transaksi aman & langsung ke nomor penjual resmi</li>
                            <li>Mendukung perekonomian & kesejahteraan desa</li>
                        </ul>
                    </div>

                    <!-- Back to Catalog Link -->
                    <div class="pt-2 text-center">
                        <a href="{{ route('umkm.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-lightblue-600 transition-colors">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali ke Katalog Belanja UMKM</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related UMKMs Carousel / Grid -->
        @if($relatedUmkms->count() > 0)
        <div class="pt-10 border-t border-slate-200/80 space-y-6">
            <div>
                <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Jelajahi UMKM Desa Lainnya</h3>
                <p class="text-sm text-slate-500">Temukan aneka kuliner, kerajinan, dan produk unggulan khas Tegalrejo</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedUmkms as $rel)
                <a href="{{ route('umkm.show', $rel->slug ?? $rel->id) }}" class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->store_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ $rel->category }}
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <h4 class="font-extrabold text-slate-900 text-lg group-hover:text-lightblue-600 transition-colors">{{ $rel->store_name }}</h4>
                            <p class="text-xs text-slate-500 font-medium"><i class="fa-solid fa-user-tie mr-1 text-slate-400"></i>{{ $rel->owner_name }}</p>
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $rel->description }}</p>
                        </div>
                    </div>
                    <div class="p-5 pt-0 flex items-center justify-between border-t border-slate-100 mt-2">
                        <span class="text-xs font-black text-amber-600">{{ $rel->price_range ?? 'Hubungi Penjual' }}</span>
                        <span class="text-xs font-bold text-lightblue-600 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            Lihat Detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>

    <!-- Image Preview Zoom Modal -->
    <div x-show="previewImage" 
         x-cloak 
         @click.self="previewImage = null"
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm p-4">
        <div class="relative max-w-4xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl p-2 animate-in fade-in zoom-in-95 duration-200">
            <button @click="previewImage = null" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-slate-900/80 hover:bg-slate-900 text-white flex items-center justify-center text-lg shadow-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img :src="previewImage" alt="Preview Foto" class="w-full max-h-[80vh] object-contain rounded-2xl">
        </div>
    </div>
</section>
@endsection
