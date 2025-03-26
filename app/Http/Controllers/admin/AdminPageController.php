<?php

namespace App\Http\Controllers\Admin;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);
     
        return view('admin.pages.index',compact('pages'));
    }

    public function create()
    {

        return view('admin.pages.create');

    }

    
    public function store(Request $request)
    {

        // dd($request->all());
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
    
        // Generate a unique slug from the name
        $slug = Str::slug($request->name);
        
        // Ensure slug uniqueness
        $count = Page::where('slug', 'LIKE', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
    
        // Create the page
        Page::create([
            'name' => $request->name,
            'slug' => $slug,
            'content' => $request->content,
        ]);
    
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }



    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
        
    }

    public function update(Request $request, $id)
    {
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'content' => 'nullable|string',
    ]);

    // Find the page
    $page = Page::findOrFail($id);

    // Generate a slug only if the name has changed
    if ($page->name !== $request->name) {
        $slug = Str::slug($request->name);
        
        // Ensure slug uniqueness
        $count = Page::where('slug', 'LIKE', $slug . '%')->where('id', '!=', $id)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
    } else {
        $slug = $page->slug;
    }

    // Update the page
    $page->update([
        'name' => $request->name,
        'slug' => $slug,
        'content' => $request->content,
    ]);

    return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
}




    public function destroy($id)
    {
        // Fetch the page by ID and delete
        $page = Page::findOrFail($id);
        $page->delete();

        // Redirect back with a success message
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
        
    }
}
