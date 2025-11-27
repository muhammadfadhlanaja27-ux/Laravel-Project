<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of tags.
     */
    public function index()
    {
        $tags = Tag::withCount('posts')
            ->latest()
            ->paginate(15);
        
        return view('posts.admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     */
    public function create()
    {
        return view('posts.admin.tags.create');
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:tags,name',
        ]);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified tag.
     */
    public function edit(Tag $tag)
    {
        return view('posts.admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil diperbarui!');
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy(Tag $tag)
    {
        // Check if tag has posts
        if ($tag->posts()->count() > 0) {
            return redirect()->route('admin.tags.index')
                ->with('error', 'Tidak dapat menghapus tag yang masih digunakan oleh postingan!');
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil dihapus!');
    }
}