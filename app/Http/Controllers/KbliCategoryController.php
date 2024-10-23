<?php

// app/Http/Controllers/KbliCategoryController.php
namespace App\Http\Controllers;

use App\Models\KbliCategory;
use Illuminate\Http\Request;

class KbliCategoryController extends Controller
{
    public function index()
    {
        $categories = KbliCategory::all();
        return view('kbli.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('kbli.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        KbliCategory::create($request->all());
        return redirect()->route('kbli-categories.index')->with('success', 'Kategori KBLI created successfully.');
    }

    public function edit(KbliCategory $category)
    {
        return view('kbli.categories.edit', compact('category'));
    }

    public function update(Request $request, KbliCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('kbli-categories.index')->with('success', 'Kategori KBLI updated successfully.');
    }

    public function destroy(KbliCategory $category)
    {
        $category->delete();
        return redirect()->route('kbli-categories.index')->with('success', 'Kategori KBLI deleted successfully.');
    }
}
