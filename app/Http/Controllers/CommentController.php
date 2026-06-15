<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tip;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments(Tip $tip)
    {
        $comments = $tip->comments()
            ->with('user')
            ->latest()
            ->get();

        return response()->json($comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_name' => $comment->user->name,
                'user_avatar' => $comment->user->avatar
                    ? asset('storage/' . $comment->user->avatar)
                    : asset('images/placeholder_user.png'),
                'created_at' => $comment->created_at->diffForHumans(),
                'can_delete' => auth()->check() && auth()->id() === $comment->user_id,
            ];
        }));
    }

    public function store(Request $request, Tip $tip)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'tip_id' => $tip->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.',
        ]);
    }
}