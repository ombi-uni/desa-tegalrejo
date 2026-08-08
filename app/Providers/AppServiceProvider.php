<?php

namespace App\Providers;

use App\Models\NavItem;
use App\Models\VillageProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            if (Schema::hasTable('nav_items')) {
                $navItems = NavItem::with('children')->root()->active()->orderBy('order')->get();
                $view->with('navItems', $navItems);
            }
            if (Schema::hasTable('village_profiles')) {
                $villageProfile = VillageProfile::first();
                $view->with('villageProfile', $villageProfile);
            }
        });
    }
}
