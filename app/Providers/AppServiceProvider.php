<?php

namespace App\Providers;

use App\Views\Composers\TestComposer;
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
        View::share(['site_title' => 'Lara.go']);
        View::composer(['home', 'post.index'], TestComposer::class);

        view()->composer(['home', 'post.create'], function(\Illuminate\View\View $view){
            $view->with(['data' => 'Data for Home and Create pages']);
        });

        view()->composer(['home', 'post.*'], function(\Illuminate\View\View $view){

            $menu = "<ul>";
            $menu .= '<li><a href="' . route('home')  . '">Home</a></li>';
            $menu .= '<li><a href="' . route('post.index') . '">Index</a></li>';
            $menu .= '<li><a href="' . route('post.create') . '">Create post</a></li>';
            $menu .= "</ul>";


            $view->with(['nav_menu' => $menu]);
        });
    }
}
