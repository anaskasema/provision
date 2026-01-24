<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // مشاركة الإعدادات مع كافة الصفحات (فقط إذا كان الجدول موجوداً)
        if (Schema::hasTable('settings')) {
            $globalSettings = Setting::pluck('value', 'key')->toArray();
            View::share('globalSettings', $globalSettings);
        }
    }
}
