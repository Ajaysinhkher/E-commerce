<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use Illuminate\Pagination\Paginator;


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
        Model::preventLazyLoading(true);
        Paginator::defaultView('components.pagination'); // Use your custom pagination

        // View::composer(['layouts.app', 'components.footer'], function ($view) {
        //     $footerPage = Page::where('slug', 'footer')->first();
        //     $footerContent =  $footerPage?->content ?? '<p>Default Footer</p>';

        //     $view->with('footerContent', $footerContent);
        // });   

        // View::composer( 'components.footer', function ($view) {
        //     $footerPage = Page::where('slug', 'footer')->first();
        //     $footerContent =  $footerPage?->content ?? '<p>Default Footer</p>';

        //     $view->with('footerContent', $footerContent);
        // });
    }
}
