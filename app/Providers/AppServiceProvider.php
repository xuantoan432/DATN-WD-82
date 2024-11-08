<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use App\View\Components\Client\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Category::with('products')
        ->orderByDesc('id')
        ->limit(10)->get());

        if (Auth::check()) {
            $user = User::with('cart.cartItems')->find(Auth::id());
            View::share('user', $user);
        }
        Blade::component('comment', Comment::class);
    }
}
