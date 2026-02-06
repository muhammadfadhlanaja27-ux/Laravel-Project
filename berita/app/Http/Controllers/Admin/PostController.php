<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib untuk fitur upload
use Illuminate\Support\Str; // Wajib untuk membuat slug otomatis

class PostController extends Controller
{
    // 1. TAMPILKAN DAFTAR POSTS
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // 2. TAMPILKAN FORM TAMBAH POSTS
    public function create()
    {
        // Kita kirim semua data Kategori dan Tag ke form
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    // 3. LOGIKA SIMPAN POSTS BARU (Wajib pakai Request)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
            'tags' => 'nullable|array',
        ]);

        // A. Handle Upload Thumbnail (Tugas 2)
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            // Simpan file di folder storage/app/public/thumbnails
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // B. Buat Post di Database
        $post = Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']), // Membuat slug otomatis
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'thumbnail' => $thumbnailPath,
            'user_id' => 1, // HARDCODE DULU, nanti kita ganti auth()->id() setelah login jadi
        ]);

        // C. Simpan Relasi Tags (Tugas 4)
        if ($request->tags) {
            // attach() digunakan untuk many-to-many (Post dengan Tag)
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Postingan baru berhasil dibuat!');
    }
    
    // 4. LOGIKA HAPUS POSTS
    public function destroy(Post $post)
    {
        // Hapus file thumbnail dari storage (Wajib!)
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        
        $post->delete(); // Otomatis hapus relasi di post_tag juga karena onDelete('cascade')
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus!');
    }
    
    // 5. LOGIKA EDIT & UPDATE (Abang bisa kembangkan sendiri dengan pola yang sama, hanya perlu handle thumbnail lama)
}