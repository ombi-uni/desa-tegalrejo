<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\VillageProfile;

class StatisticPageController extends Controller
{
    public function index()
    {
        $statistic = Statistic::first();
        $profile   = VillageProfile::first();

        return view('pages.kependudukan', compact('statistic', 'profile'));
    }
}
