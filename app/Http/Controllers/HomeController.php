<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tips = Tip::with(['user', 'category'])->get(); 
        $categories = Category::all();
        return view('user.home', compact('tips', 'categories'));    
    }
}