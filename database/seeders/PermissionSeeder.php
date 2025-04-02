<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_dashboard',
            'manage_products',
            'manage_orders',
            'manage_categories',
            'manage_customers',
            'manage_roles',
            'manage_staticblocks',
            'manage_staticpages',
            // 'manage_permissions',
            // 'manage_settings'
        ];

        $timestamp = Carbon::now();

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => Str::title(str_replace('_', ' ', $permission)), // Human readable name
                'slug' => $permission, // Unique identifier
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}

