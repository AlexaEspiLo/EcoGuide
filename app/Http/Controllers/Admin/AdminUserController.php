<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
{
    // Usamos paginate para que la paginación de abajo funcione después
    $users = User::paginate(10); 
    
    return view('admin.users', compact('users'));
}
}
