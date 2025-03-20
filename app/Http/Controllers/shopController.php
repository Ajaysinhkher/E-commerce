<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class shopController extends Controller
{
 
    public function shop()
    {
        $categories = category::all();
        $products  = product::all();
        // dd($products->toArray());
        // dd($categories->toArray(), $products->toArray());

        return view('shop',[
        'categories'=>$categories,
        'products'=>$products
    ]);
  }

}
