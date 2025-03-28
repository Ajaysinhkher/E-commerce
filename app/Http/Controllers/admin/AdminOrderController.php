<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
   public function index()
   {

    $orders = Order::with('user')->latest()->paginate(8);
 
    return view('admin.orders',compact('orders'));
   }


   public function show($id)
   {

    $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);
    return view('admin.orders.orderDetails',compact('order'));

   }

   public function update(Request $request,$id)
   {

    // store the updated value in db 

    $order = Order::findOrFail($id);

    $order->update([
        'status'=>$request->status,
    ]);

    return redirect()->route('admin.orders.index')->with('success','status updated successfully');

   }
}
