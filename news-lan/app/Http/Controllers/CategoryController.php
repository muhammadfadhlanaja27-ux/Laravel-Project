<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::withCount('posts')->get();
        // HAPUS 'popularTags' karena sudah di-handle ViewServiceProvider
        return view('Categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->with('user')->latest()->paginate(10);
        $allCategories = Category::withCount('posts')->get();
        $featuredPost = $posts->isNotEmpty() ? $posts->first() : null;

        // HAPUS 'popularTags' dari sini juga
        return view('Categories.show', [
            'category' => $category,
            'posts' => $posts,
            'allCategories' => $allCategories,
            'featuredPost' => $featuredPost,
        ]);
    }
}