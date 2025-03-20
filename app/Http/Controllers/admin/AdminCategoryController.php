<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    // display listing of categories:
    public function index()
    {
        $categories = category::all();
        return view('admin.categories',['categories'=>$categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Show validation errors
        }

        // create category 
        category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories')->with('success','category added successfully!');
    }

    public function edit($id)
    {
        $category = category::find($id);
        if(!$category)
        {
            abort(404);
        }

        return view('admin.categories.edit',['category'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category  = category::findOrFail($id);

        $category->update([
            'name' =>$request->name,
            'slug' => Str::slug($request->name),
        ]);

        // success is stored in session over here
        return redirect()->route('admin.categories')->with('success','categoriy updated successfully');
    }

    // remove category from db using desttroy method:
    public function destroy($id)
    {
        $category = category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success','category deleted successfully');
    } 


}
