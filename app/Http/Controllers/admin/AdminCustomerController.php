<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminCustomerController extends Controller
{
    public function index()
    {
        try {
            // $customers = User::all();  // Laravel automatically excludes soft-deleted users so it can be also used
            $customers = User::whereNull('deleted_at')->get(); // Only fetch active users

            return view('admin.customers', ['customers' => $customers]);
        } catch (\Exception $e) {
            Log::error('AdminCustomerController@index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load customers.');
        }
    }

    public function edit($id)
    {
        try {
            $customer = User::findOrFail($id);
            return view('admin.customers.edit', compact('customer'));

        } catch (\Exception $e) {
            Log::error('AdminCustomerController@edit Error: ' . $e->getMessage());
            return back()->with('error', 'Customer not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = User::findOrFail($id);
            $customer->update([
                'user_name' => $request->input('user_name'),
                'email' => $request->input('email'),
                'status' => $request->input('status'),
                'phone' => $request->input('phone'),
            ]);

            return redirect()->route('admin.customers')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            Log::error('AdminCustomerController@update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update customer.');
        }
    }

    public function destroy($id)
    {
        try {
            $customer = User::findOrFail($id);
            $customer->delete();

            return redirect()->route('admin.customers')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            Log::error('AdminCustomerController@destroy Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete customer.');
        }
    }

}
