<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class TipController extends Controller
{
    public function like(Request $request): JsonResponse
    {
        $tipId = $request->id;
        $userId = auth()->id();
        $tip = Tip::find($tipId);

        if (!$tip) {
            return response()->json(['error' => 'Tip no encontrado'], 404);
        }

        if ($tip->isLikedByLoggedInUser()) {
            // Dislike
            Like::where('user_id', $userId)->where('tip_id', $tipId)->delete();
            $liked = false;
        } else {
            // Like
            Like::create([
                'user_id' => $userId,
                'tip_id' => $tipId
            ]);
            $liked = true;
        }

        return response()->json([
            'count' => $tip->likes()->count(),
            'liked' => $liked
        ], 200);
    }

    public function show($id)
    {
        $tip = Tip::with(['user', 'category'])->findOrFail($id);
        return view('user.tip', compact('tip'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $tip = Tip::findOrFail($id);

        if ($tip->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tips.edit', compact('tip', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tips.create_tip', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Máximo 2MB
        ], [
            'title.max' => 'The title is very long (maximum 50 characters).',
            'description.max' => 'The description cannot exceed 500 characters.',
            'image.required' => 'Please upload an image for your Tip',
        ]);

        $imagePath = $request->file('image')->store('tips', 'public');


        Tip::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Tip shared successfully!');
    }

    public function update(Request $request, $id)
    {
        $tip = Tip::findOrFail($id);

        // Seguridad
        if ($tip->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Si sube nueva imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tips', 'public');
            $tip->image = $imagePath;
        }

        // Actualizar datos
        $tip->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('tip.show', $tip->id)
            ->with('success', 'Tip updated successfully!');
    }

    public function destroy($id)
    {
        $tip = Tip::findOrFail($id);

        if ($tip->user_id !== auth()->id()) {
            abort(403);
        }

        $tip->likes()->delete();

        if ($tip->image && \Storage::disk('public')->exists($tip->image)) {
            \Storage::disk('public')->delete($tip->image);
        }

        $tip->delete();

        return redirect()->route('home')->with('success', 'Tip deleted');
    }
}
