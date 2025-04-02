<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaticPage;

class CustomerStaticPageController extends Controller
{
    public function show($slug)
    {
        $StaticPage = StaticPage::where('slug', $slug)->firstOrFail();
        // dd($StaticPage);
        return view('contact', compact('StaticPage'));
    }
}
