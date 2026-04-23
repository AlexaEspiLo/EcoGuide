<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_status' => 'required|in:published,suspended,draft',
            'category_icon' => 'required|image|mimes:png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('category_icon')) {
            $file = $request->file('category_icon');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('icons');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $imageName);
        }

        Category::create([
            'category_name' => $validated['category_name'],
            'status' => $validated['category_status'] === 'published',
            'image' => $imageName ? 'icons/' . $imageName : '',
        ]);

        return redirect()->route('categories')->with('success', 'Categoría creada exitosamente.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_status' => 'required|in:published,suspended,draft',
            'category_icon' => 'nullable|image|mimes:png|max:2048',
        ]);

        if ($request->hasFile('category_icon')) {
            $file = $request->file('category_icon');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('icons');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $imageName);
            $category->image = 'icons/' . $imageName;
        }

        $category->category_name = $validated['category_name'];
        $category->status = $validated['category_status'] === 'published';
        $category->save();

        return redirect()->route('categories')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Categoría eliminada correctamente.');
    }
}
