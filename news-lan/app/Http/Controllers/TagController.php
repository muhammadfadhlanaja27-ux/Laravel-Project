<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Menampilkan daftar semua tag publik beserta jumlah postingan.
     */
    public function index()
    {
        $tags = Tag::withCount('posts')->orderByDesc('posts_count')->get();
        $categories = Category::all();
        return view('tags.index', compact('tags', 'categories'));
    }

    /**
     * Menampilkan postingan berdasarkan tag tertentu.
     */
    public function show(Tag $tag)
    {
        // UBAH dari $categories menjadi $allCategories agar sesuai dengan view
        $allCategories = Category::withCount('posts')->get();
        $posts = $tag->posts()->paginate(10);
        
        return view('tags.show', compact('tag', 'posts', 'allCategories'));
    }
}