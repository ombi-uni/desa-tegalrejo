@extends('layouts.app')

@section('title', 'Profil Desa - Website Resmi Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-24 overflow-hidden">
    @if(!empty($villageProfile->profile_banner_url ?? $profile->profile_banner_url ?? null))
    <div class="absolute inset-0 z-0">
        <img src="{{ $villageProfile->profile_banner_url ?? $profile->profile_banner_url }}" alt="Banner Profil Desa" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/80 to-lightblue-950/80 backdrop-blur-[1px]"></div>
    </div>
    @endif
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Profil & Aparatur Desa Tegalrejo</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base sm:text-lg">Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah.</p>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Visi Card -->
            <div class="bg-gradient-to-br from-lightblue-500 to-lightblue-700 text-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-lightblue-500/10 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl text-white">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h2 class="text-2xl font-bold uppercase tracking-wider text-lightblue-100">Visi Desa</h2>
                <blockquote class="text-lg sm:text-xl font-medium leading-relaxed italic border-l-4 border-white/40 pl-4">
                    "{{ $profile->visi ?? 'Terwujudnya Desa Tegalrejo yang Mandiri, Sejahtera, Transparan, Berbudaya, dan Berdaya Saing.' }}"
                </blockquote>
            </div>

            <!-- Misi Card -->
            <div class="bg-brokenwhite p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-md space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-lightblue-50 text-lightblue-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 uppercase tracking-wider">Misi Desa</h2>
                <div class="text-slate-700 leading-relaxed space-y-2 font-normal whitespace-pre-line text-sm sm:text-base">
                    {{ $profile->misi }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sambutan Kepala Desa Section -->
<section class="py-16 bg-brokenwhite border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-xl shadow-slate-200/50">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-4 text-center lg:text-left space-y-4">
                    <div class="relative w-48 h-48 sm:w-60 sm:h-60 mx-auto lg:mx-0 rounded-3xl overflow-hidden shadow-xl border-4 border-lightblue-100">
                        <img src="{{ !empty($profile->kades_photo) ? (str_starts_with($profile->kades_photo, 'http') ? $profile->kades_photo : asset('storage/' . $profile->kades_photo)) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $profile->kades_name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $profile->kades_name ?? 'Bpk. H. Ahmad Slamet, S.Sos.' }}</h3>
                        <p class="text-sm font-semibold text-lightblue-600">Kepala Desa Tegalrejo</p>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-4 border-t lg:border-t-0 lg:border-l border-slate-100 pt-6 lg:pt-0 lg:pl-10">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Kata Sambutan Kepala Desa</h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! $profile->kades_welcome_text !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Aparatur Desa Section -->
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Struktur Aparatur Desa Tegalrejo</h2>
            <p class="text-slate-500">Susunan jajaran Pemerintah Desa Tegalrejo yang siap melayani masyarakat.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($apparatuses as $app)
            <div class="bg-brokenwhite rounded-2xl p-6 border border-slate-200/70 shadow-md hover:shadow-xl hover:border-lightblue-300 transition-all text-center space-y-4 group">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ $app->image_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-lg text-slate-900 group-hover:text-lightblue-600 transition-colors">{{ $app->name }}</h3>
                    <p class="text-sm font-semibold text-lightblue-600 mt-0.5">{{ $app->position }}</p>
                </div>
                @if($app->phone)
                <div class="pt-2 border-t border-slate-200/60">
                    <a href="https://wa.me/{{ $app->phone }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors">
                        <i class="fa-brands fa-whatsapp text-emerald-500 text-sm"></i>
                        <span>Hubungi Kontak</span>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
