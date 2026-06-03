<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tips = Tip::with(['user', 'category', 'likes'])
            ->latest()
            ->paginate(25);

        $categories = Category::where('status', 1)
            ->has('tips')
            ->get();
        $likes = Like::all();

        return view('user.home', compact('tips', 'categories', 'likes'));
    }

    public function filter(Request $request)
    {
        $query = Tip::with(['user', 'category', 'likes']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->sort == 'oldest') {
            $query->oldest();
        } elseif ($request->sort == 'title') {
            $query->orderBy('title');
        } elseif ($request->sort == 'most_liked') {
            $query->withCount('likes')
                ->orderByDesc('likes_count');
        } else {
            $query->latest();
        }

        $tips = $query->get();

        $html = '';

        foreach ($tips as $tip) {
            $html .= view('partials.tip', compact('tip'))->render();
        }

        return $html;
    }

    public function loadMore(Request $request)
    {
        $tips = Tip::with(['user', 'category'])
            ->latest()
            ->paginate(25, ['*'], 'page', $request->page);

        $html = '';

        foreach ($tips as $tip) {
            $html .= view('partials.tip', compact('tip'))->render();
        }

        return response()->json([
            'html' => $html,
            'hasMore' => $tips->hasMorePages()
        ]);
    }


}