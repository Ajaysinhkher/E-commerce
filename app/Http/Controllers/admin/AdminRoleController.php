<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class AdminRoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all(); // Fetch all roles
            return view('admin.roles.index', compact('roles'));

        } catch (\Exception $e) {
            Log::error('Error fetching roles: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while fetching roles.');
        }
    }

    public function create()
    {
    

    try {
        $permissions = Permission::all(); // Fetch all permissions
        // dd($permissions);
        return view('admin.roles.create', compact('permissions'));

    } catch (\Exception $e) {
        Log::error('Error fetching permissions: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong while fetching permissions.');
    }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id'
            ]);
    
            // Create a new role
            $role = Role::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name))
            ]);
    
            // Attach selected permissions (ensure the relationship is defined in Role model)
            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }
    
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating the role.');
        }
    }
    
}
