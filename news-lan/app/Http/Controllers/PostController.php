<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        // cara lain jika juga butuh tags:
        //$tags = \App\Models\Tag::orderBy('name')->get();
        return view('posts.create', compact('categories', 'tags'));
    }
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // 2. Ambil data utama
        $data = $request->only(['title', 'content', 'author', 'category_id']);
        // 3. Upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }
        // 4. Simpan post baru
        $post = \App\Models\Post::create($data);
        // 5. Simpan relasi tags ke tabel pivot
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        // 6. Redirect dengan pesan sukses
        return redirect()
            ->route('posts.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit($id)
    {
        // Ambil data post dengan relasi category dan tags
        $post = Post::with(['category', 'tags'])->findOrFail($id);
        // Ambil semua kategori dan tags untuk form
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

public function update(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // 2. Temukan post
        $post = Post::findOrFail($id);
        // 3. Ambil data utama
        $data = $request->only(['title', 'content', 'author', 'category_id']);
        // 4. Jika upload thumbnail baru
        if ($request->hasFile('thumbnail')) {
            // Hapus file lama (jika ada)
            if ($post->thumbnail && \Storage::disk('public')->exists($post->thumbnail)) {
                \Storage::disk('public')->delete($post->thumbnail);
            }
            // Upload file baru
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }
        // 5. Update data post
        $post->update($data);
        // 6. Update relasi tags
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach(); // kalau tidak ada tag, kosongkan
        }
        // 7. Redirect dengan pesan sukses
        return redirect()
            ->route('posts.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil dihapus!');
    }


}