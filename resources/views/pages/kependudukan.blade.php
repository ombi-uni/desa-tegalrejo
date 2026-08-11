@extends('layouts.app')

@section('title', 'Statistik Kependudukan - Desa Tegalrejo')

@section('content')

@php
    $s = $statistic;
    $population  = (int)($s->population_count  ?? 0);
    $male        = (int)($s->male_count         ?? 0);
    $female      = (int)($s->female_count       ?? 0);
    $household   = (int)($s->household_count    ?? 0);
    $rt          = (int)($s->rt_count           ?? 0);
    $rw          = (int)($s->rw_count           ?? 0);

    $hamlets     = $s->hamlets_data    ?? [];
    $religions   = $s->religion_data   ?? [];
    $educations  = $s->education_data  ?? [];
    $ageGroups   = $s->age_group_data  ?? [];
    $occupations = $s->occupation_data ?? [];

    $totalHamlets   = collect($hamlets)->sum('count');
    $totalReligions = collect($religions)->sum('count');
    $totalEducation = collect($educations)->sum('count');
    $totalOccupation = collect($occupations)->sum('count');
    $totalAge       = collect($ageGroups)->sum('count');

    // Male/Female percentage
    $malePercent   = $population > 0 ? round(($male / $population) * 100, 1) : 0;
    $femalePercent = $population > 0 ? round(($female / $population) * 100, 1) : 0;
@endphp

{{-- ══════════════════════════════════════════════════ --}}
{{-- HERO BANNER                                        --}}
{{-- ══════════════════════════════════════════════════ --}}
<section class="relative bg-slate-950 text-white overflow-hidden">
    {{-- Decorative grid pattern --}}
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>
    {{-- Blue gradient accent --}}
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-lightblue-900/30 to-transparent pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
            <div class="space-y-5 max-w-2xl">
                <div class="inline-flex items-center gap-2.5 bg-lightblue-500/20 border border-lightblue-500/30 text-lightblue-300 text-xs font-bold px-4 py-2 rounded-full tracking-wider">
                    <i class="fa-solid fa-chart-column text-lightblue-400"></i>
                    DATA KEPENDUDUKAN RESMI
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-none">
                    Statistik<br>
                    <span class="text-lightblue-400">Kependudukan</span><br>
                    Desa Tegalrejo
                </h1>
                <p class="text-slate-400 text-base sm:text-lg leading-relaxed max-w-lg">
                    Data kependudukan resmi Desa Tegalrejo, Kecamatan Tengaran, Kabupaten Semarang — mencakup distribusi penduduk, jenis kelamin, agama, pendidikan, pekerjaan, dan kelompok usia.
                </p>
                @if(!empty($s->last_updated_note))
                <div class="flex items-start gap-2.5 bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-xs text-slate-400 max-w-md">
                    <i class="fa-solid fa-circle-info text-lightblue-400 mt-0.5 shrink-0"></i>
                    <span>{{ $s->last_updated_note }}</span>
                </div>
                @endif
            </div>

            {{-- Hero Stats Preview --}}
            <div class="grid grid-cols-2 gap-4 shrink-0 w-full lg:w-auto lg:max-w-xs">
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 text-center space-y-1">
                    <div class="text-3xl font-black text-white">{{ number_format($population) }}</div>
                    <div class="text-xs text-slate-400 font-semibold">Total Jiwa</div>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 text-center space-y-1">
                    <div class="text-3xl font-black text-lightblue-400">{{ number_format($household) }}</div>
                    <div class="text-xs text-slate-400 font-semibold">Kepala Keluarga</div>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 text-center space-y-1">
                    <div class="text-3xl font-black text-sky-400">{{ number_format($male) }}</div>
                    <div class="text-xs text-slate-400 font-semibold">Laki-laki</div>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 text-center space-y-1">
                    <div class="text-3xl font-black text-pink-400">{{ number_format($female) }}</div>
                    <div class="text-xs text-slate-400 font-semibold">Perempuan</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════ --}}
{{-- SUMMARY CARDS WITH COUNT-UP ANIMATION             --}}
{{-- ══════════════════════════════════════════════════ --}}
<section class="py-12 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $summaryCards = [
                    ['value' => $population, 'label' => 'Total Penduduk', 'unit' => 'Jiwa', 'icon' => 'fa-solid fa-users', 'color' => 'lightblue'],
                    ['value' => $male,       'label' => 'Laki-laki',      'unit' => 'Jiwa', 'icon' => 'fa-solid fa-person', 'color' => 'sky'],
                    ['value' => $female,     'label' => 'Perempuan',      'unit' => 'Jiwa', 'icon' => 'fa-solid fa-person-dress', 'color' => 'pink'],
                    ['value' => $household,  'label' => 'Kepala Keluarga','unit' => 'KK',   'icon' => 'fa-solid fa-house', 'color' => 'emerald'],
                    ['value' => $rt,         'label' => 'Rukun Tetangga', 'unit' => 'RT',   'icon' => 'fa-solid fa-map-pin', 'color' => 'amber'],
                    ['value' => $rw,         'label' => 'Rukun Warga',    'unit' => 'RW',   'icon' => 'fa-solid fa-map', 'color' => 'indigo'],
                ];
                $colorMap = [
                    'lightblue' => ['bg' => 'bg-lightblue-50', 'text' => 'text-lightblue-600', 'num' => 'text-lightblue-700'],
                    'sky'       => ['bg' => 'bg-sky-50',   'text' => 'text-sky-600',   'num' => 'text-sky-700'],
                    'pink'      => ['bg' => 'bg-pink-50',  'text' => 'text-pink-600',  'num' => 'text-pink-700'],
                    'emerald'   => ['bg' => 'bg-emerald-50','text'=> 'text-emerald-600','num'=> 'text-emerald-700'],
                    'amber'     => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'num' => 'text-amber-700'],
                    'indigo'    => ['bg' => 'bg-indigo-50','text' => 'text-indigo-600','num' => 'text-indigo-700'],
                ];
            @endphp

            @foreach($summaryCards as $card)
            @php $c = $colorMap[$card['color']]; @endphp
            <div x-data="{
                    target: {{ (int)$card['value'] }},
                    current: 0,
                    started: false,
                    init() {
                        let obs = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting && !this.started) { this.animate(); }
                        }, { threshold: 0.3 });
                        obs.observe(this.$el);
                    },
                    animate() {
                        this.started = true;
                        const dur = 1800, s = performance.now();
                        const step = (now) => {
                            const p = Math.min((now - s) / dur, 1);
                            const e = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
                            this.current = Math.round(this.target * e);
                            if (p < 1) requestAnimationFrame(step);
                            else this.current = this.target;
                        };
                        requestAnimationFrame(step);
                    }
                }" class="bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-md rounded-2xl p-4 text-center space-y-2.5 transition-all group">
                <div class="w-10 h-10 {{ $c['bg'] }} {{ $c['text'] }} rounded-xl flex items-center justify-center text-lg mx-auto group-hover:scale-110 transition-transform">
                    <i class="{{ $card['icon'] }}"></i>
                </div>
                <div>
                    <div class="text-xl sm:text-2xl font-black {{ $c['num'] }} tracking-tight" x-text="current.toLocaleString('id-ID')">{{ number_format($card['value']) }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">{{ $card['unit'] }}</div>
                </div>
                <div class="text-xs font-semibold text-slate-600 leading-tight">{{ $card['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════ --}}
{{-- MAIN CONTENT AREA                                  --}}
{{-- ══════════════════════════════════════════════════ --}}
<section class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        {{-- ── Row 1: Jenis Kelamin + Persebaran per Dusun ──────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- Card: Perbandingan Jenis Kelamin --}}
            <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-sky-400 to-pink-400 rounded-xl flex items-center justify-center text-white text-lg">
                        <i class="fa-solid fa-venus-mars"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Distribusi Jenis Kelamin</h2>
                        <p class="text-xs text-slate-500">Perbandingan penduduk laki-laki & perempuan</p>
                    </div>
                </div>

                {{-- Visual Comparison Bar --}}
                <div class="space-y-4">
                    {{-- Laki-laki --}}
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm font-bold">
                            <span class="flex items-center gap-1.5 text-sky-700"><i class="fa-solid fa-person text-sky-500 text-base"></i> Laki-laki</span>
                            <span class="text-sky-600">{{ number_format($male) }} jiwa ({{ $malePercent }}%)</span>
                        </div>
                        <div class="h-4 bg-sky-100 rounded-full overflow-hidden">
                            <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $malePercent }}, 300)"
                                 :style="'width:' + w + '%'"
                                 class="h-full bg-gradient-to-r from-sky-400 to-sky-600 rounded-full transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>
                    {{-- Perempuan --}}
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm font-bold">
                            <span class="flex items-center gap-1.5 text-pink-700"><i class="fa-solid fa-person-dress text-pink-500 text-base"></i> Perempuan</span>
                            <span class="text-pink-600">{{ number_format($female) }} jiwa ({{ $femalePercent }}%)</span>
                        </div>
                        <div class="h-4 bg-pink-100 rounded-full overflow-hidden">
                            <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $femalePercent }}, 600)"
                                 :style="'width:' + w + '%'"
                                 class="h-full bg-gradient-to-r from-pink-400 to-pink-600 rounded-full transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>
                </div>

                {{-- Ratio visual --}}
                <div class="bg-slate-50 rounded-2xl p-4 text-center space-y-1 border border-slate-100">
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Rasio Jenis Kelamin</div>
                    <div class="text-2xl font-black text-slate-800">
                        {{ $female > 0 ? round(($male / $female) * 100) : 0 }}
                    </div>
                    <div class="text-xs text-slate-500">per 100 perempuan terdapat {{ $female > 0 ? round(($male / $female) * 100) : 0 }} laki-laki</div>
                </div>
            </div>

            {{-- Card: Persebaran per Dusun --}}
            <div class="lg:col-span-3 bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-lg">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Persebaran Penduduk per Dusun</h2>
                        <p class="text-xs text-slate-500">Distribusi jumlah jiwa pada setiap dusun / lingkungan</p>
                    </div>
                </div>

                @if(count($hamlets) > 0)
                <div class="space-y-3.5">
                    @php $maxHamlet = collect($hamlets)->max('count'); @endphp
                    @foreach($hamlets as $idx => $hamlet)
                    @php
                        $pct = $maxHamlet > 0 ? round(($hamlet['count'] / $maxHamlet) * 100) : 0;
                        $popPct = $totalHamlets > 0 ? round(($hamlet['count'] / $totalHamlets) * 100, 1) : 0;
                    @endphp
                    <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $pct }}, {{ 200 + $idx * 100 }})" class="space-y-1">
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-bold text-slate-800 truncate max-w-[55%]">{{ $hamlet['label'] }}</span>
                            <span class="font-black text-lightblue-700 shrink-0 text-sm">{{ number_format($hamlet['count']) }} jiwa <span class="text-slate-400 font-normal text-xs">({{ $popPct }}%)</span></span>
                        </div>
                        <div class="h-3.5 bg-slate-100 rounded-full overflow-hidden">
                            <div :style="'width:' + w + '%'"
                                 class="h-full rounded-full transition-all duration-1000 ease-out"
                                 style="background: linear-gradient(90deg, #0ea5e9, #0284c7);"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-10 text-slate-400 gap-3">
                    <i class="fa-solid fa-map text-4xl opacity-30"></i>
                    <p class="text-sm">Data persebaran dusun belum diisi.<br><span class="text-xs">Silakan lengkapi melalui Admin → Statistik Desa.</span></p>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Row 2: Agama + Pendidikan ──────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Card: Distribusi Agama --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-lg">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Distribusi Agama yang Dianut</h2>
                        <p class="text-xs text-slate-500">Kepercayaan yang dipeluk oleh warga Desa Tegalrejo</p>
                    </div>
                </div>

                @php
                    $religionColors = ['from-emerald-400 to-teal-500', 'from-sky-400 to-blue-500', 'from-amber-400 to-orange-500', 'from-purple-400 to-violet-500', 'from-rose-400 to-pink-500', 'from-lime-400 to-green-500'];
                    $religionBgs    = ['bg-emerald-50 text-emerald-700', 'bg-sky-50 text-sky-700', 'bg-amber-50 text-amber-700', 'bg-purple-50 text-purple-700', 'bg-rose-50 text-rose-700', 'bg-lime-50 text-lime-700'];
                @endphp

                @if(count($religions) > 0)
                <div class="space-y-3.5">
                    @foreach($religions as $idx => $rel)
                    @php
                        $relPct = $totalReligions > 0 ? round(($rel['count'] / $totalReligions) * 100, 1) : 0;
                        $colorGrad = $religionColors[$idx % count($religionColors)];
                        $colorBg   = $religionBgs[$idx % count($religionBgs)];
                    @endphp
                    <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $relPct }}, {{ 150 + $idx * 120 }})" class="space-y-1.5">
                        <div class="flex justify-between items-center">
                            <span class="inline-flex items-center gap-2 text-sm font-bold text-slate-800">
                                <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br {{ $colorGrad }} shadow-sm"></span>
                                {{ $rel['label'] }}
                            </span>
                            <span class="text-xs font-black text-slate-700">{{ number_format($rel['count']) }} jiwa &nbsp;<span class="font-semibold text-slate-400">({{ $relPct }}%)</span></span>
                        </div>
                        <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                            <div :style="'width:' + w + '%'"
                                 class="h-full rounded-full bg-gradient-to-r {{ $colorGrad }} transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-10 text-slate-400 gap-3">
                    <i class="fa-solid fa-mosque text-4xl opacity-30"></i>
                    <p class="text-sm text-center">Data agama belum diisi.<br><span class="text-xs">Silakan lengkapi melalui Admin → Statistik Desa.</span></p>
                </div>
                @endif
            </div>

            {{-- Card: Jenjang Pendidikan --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-lightblue-50 text-lightblue-600 rounded-xl flex items-center justify-center text-lg">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Jenjang Pendidikan Masyarakat</h2>
                        <p class="text-xs text-slate-500">Distribusi pendidikan terakhir yang ditamatkan warga</p>
                    </div>
                </div>

                @if(count($educations) > 0)
                <div class="space-y-3.5">
                    @php $maxEdu = collect($educations)->max('count'); @endphp
                    @foreach($educations as $idx => $edu)
                    @php
                        $eduPct     = $maxEdu > 0 ? round(($edu['count'] / $maxEdu) * 100) : 0;
                        $eduRealPct = $totalEducation > 0 ? round(($edu['count'] / $totalEducation) * 100, 1) : 0;
                        $eduColors  = ['from-lightblue-400 to-lightblue-600', 'from-sky-400 to-blue-600', 'from-indigo-400 to-indigo-600', 'from-violet-400 to-violet-600', 'from-purple-400 to-purple-600', 'from-teal-400 to-teal-600', 'from-cyan-400 to-cyan-600'];
                        $ec = $eduColors[$idx % count($eduColors)];
                    @endphp
                    <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $eduPct }}, {{ 200 + $idx * 100 }})" class="space-y-1">
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-bold text-slate-800 truncate max-w-[60%]">{{ $edu['label'] }}</span>
                            <span class="font-black text-slate-700 shrink-0">{{ number_format($edu['count']) }} <span class="text-slate-400 font-normal text-xs">({{ $eduRealPct }}%)</span></span>
                        </div>
                        <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                            <div :style="'width:' + w + '%'"
                                 class="h-full rounded-full bg-gradient-to-r {{ $ec }} transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-10 text-slate-400 gap-3">
                    <i class="fa-solid fa-graduation-cap text-4xl opacity-30"></i>
                    <p class="text-sm text-center">Data pendidikan belum diisi.<br><span class="text-xs">Silakan lengkapi melalui Admin → Statistik Desa.</span></p>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Row 3: Kelompok Usia ─────────────────────────────────────────── --}}
        @if(count($ageGroups) > 0)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-lg">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-slate-900">Distribusi Kelompok Usia Penduduk</h2>
                    <p class="text-xs text-slate-500">Piramida usia penduduk Desa Tegalrejo berdasarkan kelompok umur</p>
                </div>
            </div>

            @php $maxAge = collect($ageGroups)->max('count'); @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $ageColors  = ['bg-gradient-to-r from-cyan-400 to-sky-500', 'bg-gradient-to-r from-lightblue-400 to-lightblue-600', 'bg-gradient-to-r from-emerald-400 to-teal-500', 'bg-gradient-to-r from-amber-400 to-orange-500', 'bg-gradient-to-r from-rose-400 to-pink-500'];
                    $ageIcons   = ['fa-baby', 'fa-child', 'fa-person-running', 'fa-user-tie', 'fa-person-cane'];
                    $ageTextColor = ['text-cyan-700', 'text-lightblue-700', 'text-emerald-700', 'text-amber-700', 'text-rose-700'];
                    $ageBg      = ['bg-cyan-50', 'bg-lightblue-50', 'bg-emerald-50', 'bg-amber-50', 'bg-rose-50'];
                @endphp
                @foreach($ageGroups as $idx => $age)
                @php
                    $agePct     = $maxAge > 0 ? round(($age['count'] / $maxAge) * 100) : 0;
                    $ageRealPct = $totalAge > 0 ? round(($age['count'] / $totalAge) * 100, 1) : 0;
                    $acolor     = $ageColors[$idx % count($ageColors)];
                    $aicon      = $ageIcons[$idx % count($ageIcons)];
                    $atc        = $ageTextColor[$idx % count($ageTextColor)];
                    $abg        = $ageBg[$idx % count($ageBg)];
                @endphp
                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50/60 space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 {{ $abg }} {{ $atc }} rounded-xl flex items-center justify-center text-sm">
                            <i class="fa-solid {{ $aicon }}"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-bold text-slate-800 truncate">{{ $age['label'] }}</div>
                            <div class="text-xs text-slate-500">{{ $ageRealPct }}% dari total</div>
                        </div>
                    </div>
                    <div class="text-2xl font-black {{ $atc }}">
                        {{ number_format($age['count']) }}
                        <span class="text-sm font-semibold text-slate-500">jiwa</span>
                    </div>
                    <div x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ $agePct }}, {{ 200 + $idx * 120 }})">
                        <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div :style="'width:' + w + '%'"
                                 class="h-full rounded-full {{ $acolor }} transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ── Row 4: Mata Pencaharian ──────────────────────────────────────── --}}
        @if(count($occupations) > 0)
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-7 space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-lg">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-slate-900">Mata Pencaharian Utama Warga</h2>
                    <p class="text-xs text-slate-500">Distribusi pekerjaan / profesi dominan penduduk Desa Tegalrejo</p>
                </div>
            </div>

            @php $maxOcc = collect($occupations)->max('count'); @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $occColors = [
                        ['icon' => 'fa-tractor', 'grad' => 'from-lime-400 to-green-500', 'bg' => 'bg-lime-50', 'tc' => 'text-lime-700'],
                        ['icon' => 'fa-hard-hat', 'grad' => 'from-amber-400 to-orange-500', 'bg' => 'bg-amber-50', 'tc' => 'text-amber-700'],
                        ['icon' => 'fa-store', 'grad' => 'from-blue-400 to-indigo-500', 'bg' => 'bg-blue-50', 'tc' => 'text-blue-700'],
                        ['icon' => 'fa-user-tie', 'grad' => 'from-violet-400 to-purple-500', 'bg' => 'bg-violet-50', 'tc' => 'text-violet-700'],
                        ['icon' => 'fa-graduation-cap', 'grad' => 'from-sky-400 to-lightblue-500', 'bg' => 'bg-sky-50', 'tc' => 'text-sky-700'],
                        ['icon' => 'fa-stethoscope', 'grad' => 'from-rose-400 to-pink-500', 'bg' => 'bg-rose-50', 'tc' => 'text-rose-700'],
                        ['icon' => 'fa-wrench', 'grad' => 'from-slate-400 to-slate-600', 'bg' => 'bg-slate-50', 'tc' => 'text-slate-700'],
                        ['icon' => 'fa-ellipsis', 'grad' => 'from-teal-400 to-cyan-500', 'bg' => 'bg-teal-50', 'tc' => 'text-teal-700'],
                    ];
                @endphp
                @foreach($occupations as $idx => $occ)
                @php
                    $occPct     = $maxOcc > 0 ? round(($occ['count'] / $maxOcc) * 100) : 0;
                    $occRealPct = $totalOccupation > 0 ? round(($occ['count'] / $totalOccupation) * 100, 1) : 0;
                    $oc         = $occColors[$idx % count($occColors)];
                @endphp
                <div x-data="{ w: 0, bar: {{ $occPct }} }"
                     x-init="let obs = new IntersectionObserver((e) => { if(e[0].isIntersecting) { setTimeout(() => w = bar, {{ 100 + $idx * 80 }}); } }, {threshold:0.2}); obs.observe($el);"
                     class="p-5 rounded-2xl border border-slate-100 bg-slate-50/60 space-y-3 hover:shadow-md hover:border-slate-200 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 {{ $oc['bg'] }} {{ $oc['tc'] }} rounded-xl flex items-center justify-center text-sm">
                                <i class="fa-solid {{ $oc['icon'] }}"></i>
                            </div>
                            <span class="text-sm font-bold text-slate-800 leading-tight">{{ $occ['label'] }}</span>
                        </div>
                        <span class="text-xs font-bold text-slate-500 shrink-0 ml-2">{{ $occRealPct }}%</span>
                    </div>
                    <div class="flex items-end justify-between gap-3">
                        <div class="h-2 flex-1 bg-slate-200 rounded-full overflow-hidden">
                            <div :style="'width:' + w + '%'"
                                 class="h-full rounded-full bg-gradient-to-r {{ $oc['grad'] }} transition-all duration-1000 ease-out"></div>
                        </div>
                        <span class="text-base font-black {{ $oc['tc'] }} shrink-0">{{ number_format($occ['count']) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

{{-- ══════════════════════════════════════════════════ --}}
{{-- SOURCE NOTE FOOTER SECTION                        --}}
{{-- ══════════════════════════════════════════════════ --}}
<section class="py-10 bg-slate-950 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-slate-800 text-slate-400 rounded-xl flex items-center justify-center text-lg shrink-0">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <div class="text-sm font-bold text-slate-300">Keterangan Sumber Data</div>
                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ $s->last_updated_note ?? 'Sumber: Data Administrasi Kependudukan Desa Tegalrejo, Kecamatan Tengaran, Kabupaten Semarang.' }}
                    </p>
                    <p class="text-xs text-slate-600 mt-1">Data dapat diperbarui sewaktu-waktu oleh perangkat desa melalui sistem informasi desa.</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-sm font-bold transition-all border border-slate-700">
                    <i class="fa-solid fa-building-columns text-sm"></i>
                    <span>Profil Desa</span>
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-lightblue-600 hover:bg-lightblue-700 text-white text-sm font-bold transition-all shadow-md shadow-lightblue-600/20">
                    <i class="fa-solid fa-house text-sm"></i>
                    <span>Beranda</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
