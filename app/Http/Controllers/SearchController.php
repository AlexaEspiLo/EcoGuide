<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Obtenemos el texto que el usuario escribió
        $query = $request->input('query');

        // Si el usuario tecleó algo, buscamos. Si no, mandamos colecciones vacías.
        if ($query) {
            $tips = Tip::with(['user', 'category', 'likes'])
                ->where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->get();

            $users = User::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $tips = collect();
            $users = collect();
        }

        return view('search_results', compact('tips', 'users', 'query'));
    }
}