@extends('layouts.app')

@section('title', 'Portal Berita - Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-lightblue-400 bg-lightblue-500/20 px-3.5 py-1.5 rounded-full border border-lightblue-400/30">Kabar Desa</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Portal Berita & Artikel Desa Tegalrejo</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Informasi terbaru seputar kegiatan desa, pembangunan, dan pengumuman resmi.</p>
    </div>
</section>

<!-- Filter & News Grid Section -->
<section class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Search & Filter Bar -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/80 shadow-md flex flex-col md:flex-row items-center justify-between gap-4">
            <form action="{{ route('news.index') }}" method="GET" class="w-full md:w-auto flex-1 flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita atau kata kunci..." class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-lightblue-500 focus:ring-2 focus:ring-lightblue-100 text-sm">
                </div>
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-lightblue-600 hover:bg-lightblue-700 text-white text-sm font-bold transition-colors">
                    Cari
                </button>
            </form>

            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ !request('category') ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua</a>
                <a href="{{ route('news.index', ['category' => 'Kegiatan KKN']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Kegiatan KKN' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Kegiatan KKN</a>
                <a href="{{ route('news.index', ['category' => 'Berita Utama']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Berita Utama' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Berita Utama</a>
                <a href="{{ route('news.index', ['category' => 'Kegiatan Desa']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ request('category') == 'Kegiatan Desa' ? 'bg-lightblue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Kegiatan Desa</a>
            </div>
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
