<?php

namespace App\Http\Controllers;

use App\Models\BudgetTransparency;
use App\Models\VillageProfile;

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

    public function download(BudgetTransparency $budget)
    {
        abort_if(!$budget->pdf_file, 404);

        $pathPrivate = storage_path('app/private/' . $budget->pdf_file);
        $pathPublic  = storage_path('app/public/'  . $budget->pdf_file);
        $pathRoot    = storage_path('app/'          . $budget->pdf_file);

        if (file_exists($pathPrivate)) return response()->file($pathPrivate);
        if (file_exists($pathPublic))  return response()->file($pathPublic);
        if (file_exists($pathRoot))    return response()->file($pathRoot);

        abort(404, 'File PDF tidak ditemukan.');
    }

    public function downloadDoc(string $category)
    {
        $profile = VillageProfile::first();
        abort_if(!$profile, 404);

        $field = $category . '_doc';
        $file  = $profile->$field ?? null;
        abort_if(!$file, 404);

        $paths = [
            storage_path('app/private/' . $file),
            storage_path('app/public/'  . $file),
            storage_path('app/'         . $file),
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) return response()->file($path);
        }

        abort(404, 'File dokumen tidak ditemukan.');
    }
}
