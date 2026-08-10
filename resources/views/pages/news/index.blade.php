@extends('layouts.app')

@section('title', 'Portal Berita - Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-20 overflow-hidden">
    @if(!empty($villageProfile->news_banner_url ?? null))
    <div class="absolute inset-0 z-0">
        <img src="{{ $villageProfile->news_banner_url }}" alt="Banner Portal Berita" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/80 to-lightblue-950/80 backdrop-blur-[1px]"></div>
    </div>
    @endif
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Portal Berita & Artikel Desa Tegalrejo</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Informasi terbaru seputar kegiatan desa, pembangunan, dan pengumuman resmi.</p>
    </div>
</section>

<!-- Filter & News Grid Section -->
<section class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Search & Filter Bar with Modern Minimalist Dropdown -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-md">
            <form x-ref="newsFilterForm" action="{{ route('news.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3 w-full">
                <!-- Search Input Field -->
                <div class="relative flex-1 w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul berita atau kata kunci..." 
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
                                $refs.newsFilterForm.submit();
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
                            <i class="fa-solid fa-layer-group text-lightblue-600 text-xs"></i>
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

                        @foreach(['Kegiatan KKN', 'Kemasyarakatan', 'BUMDES', 'Berita Utama', 'Kegiatan Desa', 'Pembangunan', 'Pengumuman'] as $cat)
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
                    <a href="{{ route('news.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition-colors text-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Articles Grid -->
        @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($news as $item)
            <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative h-52 overflow-hidden bg-slate-100">
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
                        <h2 class="font-bold text-xl text-slate-900 group-hover:text-lightblue-600 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        </h2>
                        <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                            {!! strip_tags($item->content) !!}
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-lightblue-600 hover:text-lightblue-700">
                        <span>Baca Berita Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $news->links() }}
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-200/80 p-8 space-y-3">
            <i class="fa-solid fa-newspaper text-5xl text-slate-300"></i>
            <h3 class="text-xl font-bold text-slate-700">Belum Ada Artikel Berita</h3>
            <p class="text-sm text-slate-500">Silakan periksa kembali kata kunci pencarian Anda atau kategori lain.</p>
        </div>
        @endif
    </div>
</section>
@endsection
