<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\AddRoleRequest;
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

    public function store(AddRoleRequest $request)
    {


        try {
            // Validate the request using AddRoleRequest class

            // Create a new role
            $role = Role::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'is_super_admin' => $request->has('is_super_admin') ? 'yes' : 'no',
            ]);

            // dd($role);

            // If super admin, assign all permissions
            if ($role->is_super_admin === 'yes') {
                // dd($role->is_super_admin);
                $allPermissions = Permission::pluck('id')->toArray();
                $role->permissions()->sync($allPermissions);
            } 
            elseif ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }
    
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating the role.');
        }
    }

    // edit role:
    public function edit($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::all();
            return view('admin.roles.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            Log::error('Error fetching role for editing: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while fetching role details.');
        }
    }

    // supdate role:
    public function update(AddRoleRequest $request, $id)
    {

        // dd($request->all());
        try {
            $role = Role::findOrFail($id);

            // validate using AddRolerequest class

            $role->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'is_super_admin' => $request->has('is_super_admin') ? 'yes' : 'no',
            ]);

            // check for super admin and attach permissions accordingly
            if ($role->is_super_admin === 'yes') {
               
                // pluck used to get specific id column 
                $allPermissions = Permission::pluck('id')->toArray();
                // adding the permissions to the selected role using sync method.
                $role->permissions()->sync($allPermissions);
            } 
            elseif ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            } 
            else {
                $role->permissions()->detach();
            }
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');


        } catch (\Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating the role.');
        }
    }

    // delete role:
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();

            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting the role.');
        }
    }
    
}
