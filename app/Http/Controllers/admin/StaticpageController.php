<?php

namespace App\Http\Controllers\Admin;

use App\Models\StaticPage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StaticPageRequest;

class StaticPageController extends Controller
{
    public function index()
    {
        $staticPages = StaticPage::paginate(10);
        return view('admin.staticpages.index', compact('staticPages'));
    }

    public function create()
    {
        return view('admin.staticpages.create');
    }

    public function store(StaticPageRequest $request)
    {
        $slug = Str::slug($request->name);
        $count = StaticPage::where('slug', 'LIKE', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        StaticPage::create([
            'name' => $request->name,
            'slug' => $slug,
            'content' => $request->content,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.staticpages.index')->with('success', 'Static page created successfully!');
    }

    public function edit($id)
    {
        $staticPage = StaticPage::findOrFail($id);
        return view('admin.staticpages.edit', compact('staticPage'));
    }

    public function update(StaticPageRequest $request, $id)
    {
        $staticPage = StaticPage::findOrFail($id);
        
        if ($staticPage->name !== $request->name) {
            $slug = Str::slug($request->name);
            $count = StaticPage::where('slug', 'LIKE', $slug . '%')->where('id', '!=', $id)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
        } else {
            $slug = $staticPage->slug;
        }

        $staticPage->update([
            'name' => $request->name,
            'slug' => $slug,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.staticpages.index')->with('success', 'Static page updated successfully!');
    }

    public function destroy($id)
    {
        $staticPage = StaticPage::findOrFail($id);
        $staticPage->delete();

        return redirect()->route('admin.staticpages.index')->with('success', 'Static page deleted successfully!');
    }
}
