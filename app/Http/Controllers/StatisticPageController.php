<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\VillageProfile;

class StatisticPageController extends Controller
{
    public function index()
    {
        $statistic = Statistic::latest('updated_at')->first();
        $profile   = VillageProfile::first();

        return view('pages.kependudukan', compact('statistic', 'profile'));
    }
}
