<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AddnewAdminController extends Controller
{
    public function index()

    {
       

        try {
            $admins = Admin::with('role')->get(); // Eager load role
            // dd($admins);
            return view('admin.admins.index', compact('admins'));


        } catch (\Exception $e) {
            Log::error('Error fetching admins: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while fetching admins.');
        }
    }

    public function create()
    {
        try {
            $roles = Role::all(); // Fetch all roles
            return view('admin.admins.create', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Error fetching roles: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while fetching roles.');
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email', // Correct table name
                'password' => 'required|min:6|confirmed',
                'role_id' => 'required|exists:roles,id'
            ]);
    
            // Create new admin user
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id // Directly assigning role_id
            ]);
    
            return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating admin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating the admin.');
        }
    }

    // edit admin:
    public function edit($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $roles = Role::all();
            return view('admin.admins.edit', compact('admin', 'roles'));
        } catch (\Exception $e) {
            Log::error('Error fetching admin for edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while fetching the admin.');
        }
    }

    // update admin:
    public function update(Request $request, $id)
    {
        try {
            // Validate input
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email,' . $id,
                'role_id' => 'required|exists:roles,id',
                'password' => 'nullable|min:6|confirmed'
            ]);

            $admin = Admin::findOrFail($id);

            // Update fields
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->role_id = $request->role_id;

            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }

            $admin->save();

            return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating admin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating the admin.');
        }
    }

    // delete admin:
    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting admin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting the admin.');
        }
    }

    

}
