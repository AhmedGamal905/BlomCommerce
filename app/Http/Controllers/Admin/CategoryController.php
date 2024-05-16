<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->latest()
            ->paginate();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:20'],
        ]);

        Category::create($data);

        return to_route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.update', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => ['required', 'max:20'],
        ]);

        $category->update($data);

        return to_route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('dashboard.categories.index');
    }
}
