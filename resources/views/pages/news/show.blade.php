@extends('layouts.app')

@section('title', $article->title . ' - Desa Tegalrejo')

@section('content')
<article class="py-12 bg-brokenwhite">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-lightblue-600">Beranda</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-lightblue-600">Portal Berita</a>
            <span>/</span>
            <span class="text-slate-800 truncate max-w-xs">{{ $article->title }}</span>
        </nav>

        <!-- Article Header -->
        <header class="space-y-4">
            <span class="inline-block bg-lightblue-100 text-lightblue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                {{ $article->category }}
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight">
                {{ $article->title }}
            </h1>
            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500 border-y border-slate-200/80 py-3">
                <div class="flex items-center gap-1.5">
                    <i class="fa-regular fa-user text-lightblue-600"></i>
                    <span>Penulis: <strong>{{ $article->author }}</strong></span>
                </div>
                <span>&bull;</span>
                <div class="flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar text-lightblue-600"></i>
                    <span>Diterbitkan: {{ optional($article->published_at)->format('d F Y, H:i') ?? 'Terbaru' }}</span>
                </div>
            </div>
        </header>

        <!-- Main Featured Image -->
        @if($article->thumbnail)
        <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/80 bg-slate-100 aspect-video">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Social Media Share Buttons (WA, X, FB, IG, Telegram) -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider"><i class="fa-solid fa-share-nodes text-lightblue-600 mr-1.5"></i> Bagikan Artikel Ini:</span>
            <div class="flex flex-wrap items-center gap-2">
                <!-- WhatsApp Share -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                </a>
                <!-- X / Twitter Share -->
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-brands fa-x-twitter text-sm"></i> X (Twitter)
                </a>
                <!-- Facebook Share -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-brands fa-facebook-f text-sm"></i> Facebook
                </a>
                <!-- Telegram Share -->
                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-brands fa-telegram text-sm"></i> Telegram
                </a>
                <!-- Instagram Copy Link -->
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Tautan berita berhasil disalin! Anda dapat membagikannya di Instagram.');" class="px-3.5 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-500 hover:opacity-90 text-white text-xs font-bold flex items-center gap-1.5 transition-colors">
                    <i class="fa-brands fa-instagram text-sm"></i> Copy Link IG
                </button>
            </div>
        </div>

        <!-- Article Rich Content -->
        <div class="bg-white p-8 sm:p-12 rounded-3xl border border-slate-200/80 shadow-md prose prose-slate max-w-none prose-lg leading-relaxed">
            {!! $article->content !!}
        </div>

        <!-- Recent Articles Slider/Sidebar -->
        <div class="pt-8 space-y-6">
            <h3 class="text-xl font-bold text-slate-900 border-l-4 border-lightblue-600 pl-3">Berita Lainnya</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($recentNews as $recent)
                <a href="{{ route('news.show', $recent->slug) }}" class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-lightblue-300 flex items-center gap-4 transition-all group">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                        <img src="{{ $recent->thumbnail ?? 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-lightblue-600 uppercase">{{ $recent->category }}</span>
                        <h4 class="font-bold text-sm text-slate-900 group-hover:text-lightblue-600 line-clamp-2 transition-colors">{{ $recent->title }}</h4>
                        <span class="text-[11px] text-slate-400 block">{{ optional($recent->published_at)->format('d M Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</article>
@endsection
