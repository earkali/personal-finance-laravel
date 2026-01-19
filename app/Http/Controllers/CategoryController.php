<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:income,expense'],
        ]);

        $validated['user_id'] = auth()->id();

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(string $id): View
    {
        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:income,expense'],
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
