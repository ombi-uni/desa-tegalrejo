<?php

namespace App\Http\Controllers;

use App\Models\Apparatus;
use App\Models\VillageProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();
        $apparatuses = Apparatus::where('is_active', true)->orderBy('order_level')->get();

        return view('pages.profile', compact('profile', 'apparatuses'));
    }
}
