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
    
}