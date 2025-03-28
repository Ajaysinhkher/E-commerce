<?php

namespace App\Http\Controllers\Admin;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;

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

    
    public function store(PageRequest $request)
    {

        // dd($request->content);
        // Validate the request sing PageRequest class
    
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
            'status' => $request->status ?? 'active',
        ]);
    
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }



    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
        
    }

    public function update(PageRequest $request, $id)
    {
    // Validate the request using PageRequest class

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
        'status' => $request->status,
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
