<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        $tags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(10)
            ->get();

        return view('posts.index', compact('posts', 'tags'));
    }

    public function show(Post $post)
    {
        // Load relasi yang diperlukan
        $post->load([
            'category',           // Load kategori
            'tags',               // Load tags
            'approvedComments' => function ($query) {
                $query->with('user')->latest(); // Load comments dengan user, urutkan terbaru
            }
        ]);

        return view('posts.show', compact('post'));
    }

    /**
     * Search posts by title, content, category, or tags
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Validasi input search tidak boleh kosong
        if (empty($query)) {
            return redirect()->route('home')->with('error', 'Please enter a search keyword.');
        }

        // Search di title, content, category name, dan tag name
        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('tags', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->with(['category', 'tags']) // Eager loading untuk performa
            ->latest()
            ->paginate(10)
            ->appends(['q' => $query]); // Maintain search query di pagination

        return view('posts.search', compact('posts', 'query'));
    }
}