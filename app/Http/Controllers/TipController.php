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
            'category_id'    => 'required|integer',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // Máximo 2MB
        ], [
            'title.max' => 'The title is very long (maximum 50 characters).',
            'description.max' => 'The description cannot exceed 500 characters.',
            'image.required' => 'Please upload an image for your Tip',
        ]);

            $imagePath = $request->file('image')->store('tips', 'public');
        

        Tip::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id'    => $request->category_id,
            'image'   => $imagePath,
        ]);

        return redirect()->route('tips.create')->with('success', '¡Tip cshared successfully!');
    }
}