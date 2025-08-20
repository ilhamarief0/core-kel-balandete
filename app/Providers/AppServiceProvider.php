<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\News;
use App\Models\Service;
use App\Models\WebsiteSetting;
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
        $websiteSettings = WebsiteSetting::first();
        $serviceList = Service::take(5)->latest()->get();
        $newsList = News::take(5)->latest()->get();
        $contactCount = ContactUs::where('is_read', false)->count();
        $contactContent = ContactUs::orderBy('created_at', 'desc')->limit(5)->get();
        View::share('websiteSetting', $websiteSettings);
        View::share('websiteName', $websiteSettings ? $websiteSettings->website_name : 'Core Web Profil');
        View::share('websiteIcon', $websiteSettings ? $websiteSettings->website_logo : 'default-icon.png');
        View::share('websiteDescription', $websiteSettings ? $websiteSettings->website_description : 'Tess');
        View::share('newsList', $newsList);
        View::share('contactCount', $contactCount);
        View::share('serviceList', $serviceList);
        View::share('contactContent', $contactContent);
    }
}
