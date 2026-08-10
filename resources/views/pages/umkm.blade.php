@extends('layouts.app')

@section('title', 'Katalog Belanja UMKM Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-20 overflow-hidden">
    @if(!empty($villageProfile->umkm_banner_url ?? null))
    <div class="absolute inset-0 z-0">
        <img src="{{ $villageProfile->umkm_banner_url }}" alt="Banner Belanja UMKM" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/80 to-lightblue-950/80 backdrop-blur-[1px]"></div>
    </div>
    @endif
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Katalog Produk & Usaha Lokal</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Dukung perekonomian warga Desa Tegalrejo. Produk berkualitas buatan tangan warga lokal, berizin resmi, dan bisa dipesan langsung via WhatsApp.</p>
    </div>
</section>

<!-- UMKM Showcase Section -->
<section x-data="{ selectedUmkm: null }" class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Search & Filter Category with Modern Minimalist Dropdown -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-md">
            <form x-ref="umkmFilterForm" action="{{ route('umkm.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3 w-full">
                <!-- Search Input Field -->
                <div class="relative flex-1 w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama usaha, produk, atau nama pemilik..." 
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-lightblue-500 focus:ring-2 focus:ring-lightblue-100 text-sm placeholder:text-slate-400 bg-white">
                </div>

                <!-- Custom Modern Minimalist Category Dropdown -->
                <div x-data="{ 
                        open: false, 
                        selected: '{{ request('category') ? request('category') : 'Semua Kategori' }}',
                        value: '{{ request('category') ?? '' }}',
                        selectCategory(val, label) {
                            this.selected = label;
                            this.value = val;
                            this.open = false;
                            $nextTick(() => {
                                $refs.umkmFilterForm.submit();
                            });
                        }
                     }" 
                     class="relative w-full md:w-64 shrink-0" 
                     @click.outside="open = false">
                    
                    <!-- Hidden Input for submission -->
                    <input type="hidden" name="category" :value="value">

                    <!-- Trigger Button -->
                    <button type="button" 
                            @click="open = !open" 
                            class="w-full flex items-center justify-between gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:border-lightblue-400 focus:outline-none focus:ring-2 focus:ring-lightblue-100 transition-all text-sm font-semibold text-slate-700 shadow-sm text-left">
                        <div class="flex items-center gap-2.5 truncate">
                            <i class="fa-solid fa-shop text-lightblue-600 text-xs"></i>
                            <span x-text="selected" class="truncate"></span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[11px] text-slate-400 transition-transform duration-200" :class="{ 'rotate-180 text-lightblue-600': open }"></i>
                    </button>

                    <!-- Dropdown List Popover -->
                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                         class="absolute z-50 left-0 right-0 mt-2 p-1.5 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-slate-100 max-h-64 overflow-y-auto space-y-0.5">
                        
                        <button type="button" 
                                @click="selectCategory('', 'Semua Kategori')"
                                class="w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-semibold transition-all text-left"
                                :class="value === '' ? 'bg-lightblue-600 text-white font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-lightblue-600'">
                            <span>Semua Kategori</span>
                            <i x-show="value === ''" class="fa-solid fa-check text-xs"></i>
                        </button>

                        @foreach(['Kuliner', 'Kerajinan', 'Pertanian & Peternakan', 'Jasa & Lainnya'] as $cat)
                        <button type="button" 
                                @click="selectCategory('{{ $cat }}', '{{ $cat }}')"
                                class="w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-semibold transition-all text-left"
                                :class="value === '{{ $cat }}' ? 'bg-lightblue-600 text-white font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-lightblue-600'">
                            <span>{{ $cat }}</span>
                            <i x-show="value === '{{ $cat }}'" class="fa-solid fa-check text-xs"></i>
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons (Cari & Reset) -->
                <div class="flex items-center gap-2 w-full md:w-auto shrink-0">
                    <button type="submit" class="flex-1 md:flex-initial px-6 py-2.5 rounded-xl bg-lightblue-600 hover:bg-lightblue-700 active:scale-95 text-white text-sm font-bold transition-all shadow-sm">
                        Cari
                    </button>
                    @if(request('search') || request('category'))
                    <a href="{{ route('umkm.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition-colors text-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Products & UMKM Grid -->
        @if($umkms->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($umkms as $item)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                <a href="{{ route('umkm.show', $item->slug ?? $item->id) }}" class="block">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="{{ $item->image_url }}" alt="{{ $item->store_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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

                        <!-- Legal Badges (NIB, PIRT, Halal, BPOM) -->
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            @if($item->has_nib)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold px-2.5 py-1 rounded-full inline-flex items-center gap-1.5"><i class="fa-solid fa-certificate text-[11px]"></i> NIB Resmi</span>
                            @endif
                            @if($item->has_pirt)
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold px-2.5 py-1 rounded-full inline-flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-[11px]"></i> PIRT</span>
                            @endif
                            @if($item->has_halal)
                                <span class="bg-teal-50 text-teal-700 border border-teal-200 text-xs font-bold px-2.5 py-1 rounded-full inline-flex items-center gap-1.5"><i class="fa-solid fa-moon text-[11px]"></i> Halal</span>
                            @endif
                            @if($item->has_bpom)
                                <span class="bg-indigo-50 text-indigo-700 border border-indigo-200 text-xs font-bold px-2.5 py-1 rounded-full inline-flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-[11px]"></i> BPOM</span>
                            @endif
                        </div>
                    </div>
                </a>

                <div class="p-6 pt-0 space-y-3">
                    <div class="flex items-center justify-between border-t border-slate-100 pt-4 gap-2">
                        <div class="min-w-0">
                            <span class="text-[11px] text-slate-400 block font-medium uppercase tracking-wider">Perkiraan Harga</span>
                            <span class="text-sm font-black text-amber-600 truncate block">{{ $item->price_range_formatted }}</span>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('umkm.show', $item->slug ?? $item->id) }}" class="px-4 py-2.5 rounded-xl bg-lightblue-600 hover:bg-lightblue-700 active:scale-95 text-white text-xs font-bold flex items-center gap-1.5 shadow-md shadow-lightblue-600/20 transition-all">
                                <span>Lihat Detail Toko</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
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
