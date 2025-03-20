<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index() {
        // fetch all the products
        $products  = product::all();

        return view('index',['products'=>$products]);  //passing products to index blade
    }
}
