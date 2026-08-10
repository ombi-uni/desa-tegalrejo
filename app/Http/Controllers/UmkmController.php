<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query();

        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('store_name', 'like', '%' . $request->search . '%')
                  ->orWhere('product_name', 'like', '%' . $request->search . '%')
                  ->orWhere('owner_name', 'like', '%' . $request->search . '%');
            });
        }

        $umkms = $query->latest()->paginate(12);

        return view('pages.umkm', compact('umkms'));
    }

    public function show(string $slug)
    {
        $umkm = Umkm::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

        $relatedUmkms = Umkm::where('id', '!=', $umkm->id)
            ->where(function ($q) use ($umkm) {
                $q->where('category', $umkm->category)->orWhere('is_featured', true);
            })
            ->take(3)
            ->get();

        return view('pages.umkm.show', compact('umkm', 'relatedUmkms'));
    }
}

