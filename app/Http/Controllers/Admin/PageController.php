<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::all();
        $page = $pages->first();

        return view('admin.info-pages', compact('pages', 'page'));
    }

    public function edit($slug)
    {
        $pages = Page::all();
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.info-pages', compact('pages', 'page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page = Page::findOrFail($id);

        $page->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Page updated successfully');
    }
}

