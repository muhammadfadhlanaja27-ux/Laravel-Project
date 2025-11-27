<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Menampilkan daftar berita di panel admin.
     */
    public function index()
    {
        $posts = Post::with(['category', 'tags'])
                    ->latest()
                    ->paginate(10);
        
        return view('posts.admin.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.admin.create', compact('categories', 'tags'));
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
        ]);

        // Ambil data yang sudah divalidasi
        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'] ?? null,
            'author' => Auth::user()->name, // Ambil nama user yang login
        ];

        // Upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            try {
                $path = $request->file('thumbnail')->store('thumbnails', 'public');
                $data['thumbnail'] = $path;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal upload thumbnail: ' . $e->getMessage())
                            ->withInput();
            }
        }

        try {
            // Buat post baru
            $post = Post::create($data);

            // Sync tags jika ada
            if (isset($validated['tags']) && is_array($validated['tags'])) {
                $post->tags()->sync($validated['tags']);
            }

            return redirect()->route('dashboard')
                           ->with('success', 'Berita berhasil ditambahkan!');
                           
        } catch (\Exception $e) {
            // Jika ada error, hapus thumbnail yang sudah diupload
            if (isset($data['thumbnail']) && Storage::disk('public')->exists($data['thumbnail'])) {
                Storage::disk('public')->delete($data['thumbnail']);
            }
            
            return back()->with('error', 'Gagal menyimpan berita: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Post $post)
    {
        $post->load(['category', 'tags']);
        
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.admin.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Memperbarui berita di database.
     */
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ambil data yang sudah divalidasi
        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'] ?? null,
        ];

        // Upload thumbnail baru jika ada
        if ($request->hasFile('thumbnail')) {
            try {
                // Hapus thumbnail lama
                if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                    Storage::disk('public')->delete($post->thumbnail);
                }
                
                // Upload thumbnail baru
                $path = $request->file('thumbnail')->store('thumbnails', 'public');
                $data['thumbnail'] = $path;
                
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal upload thumbnail: ' . $e->getMessage())
                            ->withInput();
            }
        }

        try {
            // Update post
            $post->update($data);

            // Sync tags
            if (isset($validated['tags']) && is_array($validated['tags'])) {
                $post->tags()->sync($validated['tags']);
            } else {
                // Hapus semua tag jika tidak ada yang dipilih
                $post->tags()->detach();
            }

            return redirect()->route('dashboard')
                           ->with('success', 'Berita berhasil diperbarui!');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy(Post $post)
    {
        try {
            // Hapus thumbnail dari storage
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            // Hapus relasi tags
            $post->tags()->detach();
            
            // Hapus post
            $post->delete();
            
            return redirect()->route('dashboard')
                           ->with('success', 'Berita berhasil dihapus!');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }
}