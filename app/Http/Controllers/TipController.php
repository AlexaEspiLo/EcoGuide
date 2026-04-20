<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip; 
use Illuminate\Support\Facades\Storage;

class TipController extends Controller
{
    
    public function create()
    {
        return view('tips.create_tip');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'category'    => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // Máximo 2MB
        ], [
            'title.max' => 'The title is very long (maximum 50 characters).',
            'description.max' => 'The description cannot exceed 500 characters.'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tips', 'public');
        }

        Tip::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'image_url'   => $imagePath, // Guarda la ruta
        ]);

        return redirect()->route('tips.create')->with('success', '¡Tip compartido con éxito!');
    }
}