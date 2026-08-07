<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use App\Models\Statistic;
use App\Models\Umkm;
use App\Models\VillageProfile;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $profile = VillageProfile::first();
        $statistic = Statistic::first();
        $featuredUmkms = Umkm::where('is_featured', true)->take(4)->get();
        $latestNews = News::where('status', 'published')->latest('published_at')->take(3)->get();

        return view('pages.home', compact('banners', 'profile', 'statistic', 'featuredUmkms', 'latestNews'));
    }
}
