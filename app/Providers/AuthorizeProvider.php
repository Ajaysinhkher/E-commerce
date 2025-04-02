<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class AuthorizeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    Log::info('AuthorizeProvider is booting...');

    $permissions = Permission::all();  // This should return a collection

    foreach ($permissions as $permission) {
        Log::info('Defining gate for permission:', ['id' => $permission->id, 'slug' => $permission->slug]); // Debugging log
        
        Gate::define($permission->slug, function (Admin $admin) use ($permission) {
            Log::info('Checking permission for:', ['slug' => $permission->slug]);
            return $admin->hasPermission($permission->slug);
        });
    }
}
}
