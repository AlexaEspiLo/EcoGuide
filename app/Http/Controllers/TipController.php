<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        $tip = Tip::findOrFail($id);

        // Seguridad: solo el dueño puede editar
        if ($tip->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tips.edit', compact('tip'));
    }

    public function create()
    {
        return view('tips.create_tip');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'category_id' => 'required|integer',
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
        ]);

        return redirect()->route('tips.create')->with('success', '¡Tip cshared successfully!');
    }

}
