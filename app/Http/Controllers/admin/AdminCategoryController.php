<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminCategoryController extends Controller
{
    // Display listing of categories:
    public function index()
    {
        try {
            $categories = Category::all();
            return view('admin.categories', ['categories' => $categories]);
            
        } catch (\Exception $e) {
            Log::error('AdminCategoryController@index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load categories.');
        }
    }

    public function create()
    {
        try {
            return view('admin.categories.create');
        } catch (\Exception $e) {
            Log::error('AdminCategoryController@create Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load category creation page.');
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            
            // validation using CategoryRequst class

            // Create category 
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status'=>$request->status ?? 'active',
            ]);

            return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('AdminCategoryController@store Validation Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('AdminCategoryController@store Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to add category. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', ['category' => $category]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('AdminCategoryController@edit Error: Category not found with ID ' . $id);
            return redirect()->route('admin.categories')->with('error', 'Category not found.');
        } catch (\Exception $e) {
            
            Log::error('AdminCategoryController@edit Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load category edit page.');
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
        
            // validation using CategoryRequest Class
            $category = Category::findOrFail($id);

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status'=>$request->status,
            ]);

            return redirect()->route('admin.categories')->with('success', 'Category updated successfully');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('AdminCategoryController@update Validation Error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('AdminCategoryController@update Error: Category not found with ID ' . $id);
            return redirect()->route('admin.categories')->with('error', 'Category not found.');

        } catch (\Exception $e) {
            Log::error('AdminCategoryController@update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update category.');
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('AdminCategoryController@destroy Error: Category not found with ID ' . $id);
            return redirect()->route('admin.categories')->with('error', 'Category not found.');

        } catch (\Exception $e) {
            Log::error('AdminCategoryController@destroy Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete category.');
        }
    }

        // Display a list of soft-deleted categories.

        public function deletedCategories()
        {
            try {
                $deletedCategories = Category::onlyTrashed()->paginate(4);
                // dd($deletedProducts);
                return view('admin.categories.deleted', ['categories' => $deletedCategories]);
    
            } catch (\Exception $e) {
                Log::error('AdminProductController@deletedProducts Error: ' . $e->getMessage());
                return back()->with('error', 'Failed to load deleted products.');
            }
        }


    // Restore a soft deleted category.
    public function restore($id)
    {
        try {

            $category = Category::withTrashed()->findOrFail($id);
            $category->restore();

            return redirect()->route('admin.categories.deleted')->with('success', 'category restored successfully.');
            
        } catch (\Exception $e) {
            Log::error('AdminCategoryController@restore Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to restore category.');
        }
    }

    
    // Permanently delete a soft-deleted product.
    public function forceDelete($id)
    {
        try {
            $category = Category::withTrashed()->findOrFail($id);
            
            // Delete product image from storage if exists
            // if ($product->image) {
            //     Storage::delete('public/' . $product->image);
            // }

            $category->forceDelete(); // Permanently delete

            return redirect()->route('admin.categories.deleted')->with('success', 'Product permanently deleted.');
            
        } catch (\Exception $e) {
            Log::error('AdminCategoryController@forceDelete Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete category permanently.');
        }
    }


}
