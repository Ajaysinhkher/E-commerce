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
    public function boot(): void
    {
        // Log initialization
        Log::info("AuthorizeProvider boot method initialized.");
    
        // Define gates for admin permissions
        
        Gate::define('manage_categories', function ($admin) {
            // dd($admin);
            Log::info("Checking manage_categories permission for admin: {$admin->id}");
            $hasPermission = $admin->hasPermission('manage_categories');
            Log::info("Admin {$admin->id} has manage_categories permission: " . ($hasPermission ? 'Yes' : 'No'));
            return $hasPermission;
        });
    
        Gate::define('manage_products', function ($admin) {
            Log::info("Checking manage_products permission for admin: {$admin->id}");
            $hasPermission = $admin->hasPermission('manage_products');
            Log::info("Admin {$admin->id} has manage_products permission: " . ($hasPermission ? 'Yes' : 'No'));
            return $hasPermission;
        });

        Gate::define('manage_orders', function ($admin) {
            Log::info("Checking manage_orders permission for admin: {$admin->id}");
            $hasPermission = $admin->hasPermission('manage_orders');
            Log::info("Admin {$admin->id} has manage_orders permission: " . ($hasPermission ? 'Yes' : 'No'));
            return $hasPermission;
        });
    
        // permission for static blocks:
        Gate::define('manage_staticblocks', function ($admin) {
            Log::info("Checking manage_staticblocks permission for admin: {$admin->id}");
            $hasPermission = $admin->hasPermission('manage_staticblocks');
            Log::info("Admin {$admin->id} has manage_staticblocks permission: " . ($hasPermission ? 'Yes' : 'No'));
            return $hasPermission;
        });
        // Super admin has all permissions
        Gate::before(function ($admin, $permission) {
            Log::info("Checking if admin {$admin->id} is a Super Admin for permission: {$permission}");
        
            if ($admin->isSuperAdmin()) {
                Log::info("Admin {$admin->id} is a Super Admin. Granting all permissions.");
                return true; // Super Admin bypasses all checks
            }
        
            Log::info("Admin {$admin->id} is NOT a Super Admin. Checking individual permissions.");
            return null; // Continue checking specific permissions
        });
            
    
        Log::info("AuthorizeProvider boot method execution completed.");
    }
    
}
