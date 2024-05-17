<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\ViewCompilationException;

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
      view()->composer('layouts.frontentLayout', function($view){
         $view->with([
          'categories' => Category::with('subcategories')->select('id', 'category_id' , 'categoryName', 'slug')->whereNull('category_id')->get(),
          'cartCount' => Cart::where('customer_id', auth('customer')->id())->count()
         ]);
      });

      Paginator::useBootstrapFive();
    }
}
