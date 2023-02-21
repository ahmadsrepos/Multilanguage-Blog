<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Page;

use Schema;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('users')) 
        {
            $settings = Setting::handleSettings();
            User::createAdmin();
            $categories = Category::with('getChildren')->where('parent', NULL)->get();
            $latestPosts = Post::latest()->take(6)->get();
            $pages = Page::all();
            
            View()->share([
    
                'setting' => $settings,
                'categories' => $categories,
                'latestPosts' => $latestPosts,
                'pages' => $pages
            ]);
    
            Paginator::useBootstrapFive();
            Paginator::useBootstrapFour();
        }
    }
}
