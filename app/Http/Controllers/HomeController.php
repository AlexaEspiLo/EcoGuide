<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && !auth()->user()->privacy_accepted) {
            return redirect()->route('privacidad');
        }
        $tips = Tip::with(['user', 'category'])->get(); 
        $categories = Category::all();
        return view('user.home', compact('tips', 'categories'));    
    }
}