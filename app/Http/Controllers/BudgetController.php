<?php

namespace App\Http\Controllers;

use App\Models\BudgetTransparency;

class BudgetController extends Controller
{
    public function index()
    {
        $pendapatan = BudgetTransparency::where('category', 'Pendapatan')->get();
        $belanja = BudgetTransparency::where('category', 'Belanja')->get();
        $pembiayaan = BudgetTransparency::where('category', 'Pembiayaan')->get();

        $totalPendapatan = $pendapatan->sum('amount');
        $totalBelanja = $belanja->sum('amount');
        $totalPembiayaan = $pembiayaan->sum('amount');

        return view('pages.budget', compact('pendapatan', 'belanja', 'pembiayaan', 'totalPendapatan', 'totalBelanja', 'totalPembiayaan'));
    }
}
