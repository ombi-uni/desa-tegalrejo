@extends('layouts.app')

@section('title', 'Transparansi Anggaran Desa (APBDES) - Desa Tegalrejo')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-slate-900 via-slate-800 to-lightblue-900 text-white py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-lightblue-400 bg-lightblue-500/20 px-3.5 py-1.5 rounded-full border border-lightblue-400/30">Keterbukaan Informasi Publik</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Transparansi Anggaran Desa (APBDES)</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Laporan pertanggungjawaban Pendapatan, Belanja, dan Pembiayaan Desa Tegalrejo Tahun Anggaran 2026.</p>
    </div>
</section>

<!-- Budget Breakdown Section -->
<section class="py-16 bg-brokenwhite">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Pendapatan -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-lg shadow-slate-200/50 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Pendapatan Desa</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-500 font-medium">Dana Desa, ADD, & Bagi Hasil Pajak</p>
            </div>

            <!-- Total Belanja -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-lg shadow-slate-200/50 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-600 bg-rose-50 px-3 py-1 rounded-full">Belanja Desa</span>
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-500 font-medium">Pemerintahan, Pembangunan, & UMKM</p>
            </div>

            <!-- Total Pembiayaan -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-lg shadow-slate-200/50 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Pembiayaan (SILPA)</span>
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                        <i class="fa-solid fa-piggy-bank"></i>
                    </div>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Rp {{ number_format($totalPembiayaan, 0, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-500 font-medium">Cadangan & Penerimaan Pembiayaan</p>
            </div>
        </div>

        <!-- Detail Tables Section -->
        <div class="space-y-8">
            <!-- Table 1: Pendapatan -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md overflow-hidden">
                <div class="bg-emerald-600 text-white p-6 flex items-center justify-between">
                    <h3 class="font-bold text-lg flex items-center gap-2">
                        <i class="fa-solid fa-circle-arrow-down"></i>
                        <span>Rincian Pendapatan Desa 2026</span>
                    </h3>
                    <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full">Kategori 01</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Pos Uraian Anggaran</th>
                                <th class="px-6 py-4">Tahun</th>
                                <th class="px-6 py-4 text-right">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($pendapatan as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $item->title }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $item->year }}</td>
                                <td class="px-6 py-4 text-right font-extrabold text-emerald-600">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table 2: Belanja -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md overflow-hidden">
                <div class="bg-rose-600 text-white p-6 flex items-center justify-between">
                    <h3 class="font-bold text-lg flex items-center gap-2">
                        <i class="fa-solid fa-circle-arrow-up"></i>
                        <span>Rincian Belanja Desa 2026</span>
                    </h3>
                    <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full">Kategori 02</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Pos Uraian Anggaran</th>
                                <th class="px-6 py-4">Tahun</th>
                                <th class="px-6 py-4 text-right">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($belanja as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $item->title }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $item->year }}</td>
                                <td class="px-6 py-4 text-right font-extrabold text-rose-600">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
