@extends('layouts.app')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Header Kategori -->
    <div class="mb-8 text-center lg:text-left">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-2">
            Articles in: <span class="text-yellow-500">{{ $category->name }}</span>
        </h1>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        <!-- Main Content: Grid Posts -->
        <div class="lg:w-3/4">
            @if($posts->isEmpty())
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg shadow-md">
                    <p class="font-bold">No articles found</p>
                    <p>No posts in "{{ $category->name }}" yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($posts as $post)
                        <!-- Card Postingan -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            
                            <!-- Gambar/Thumbnail - SEKARANG DIBUNGKUS OLEH TAG A agar bisa diklik -->
                            <a href="{{ route('posts.show', $post) }}" class="block relative h-48 bg-gray-200 group">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        No Image
                                    </div>
                                @endif

                                <!-- Label Kategori -->
                                <div class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                                    {{ $category->name }}
                                </div>
                            </a>

                            <!-- Konten -->
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">
                                    <!-- Judul juga tetap bisa diklik -->
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-yellow-600 transition-colors">
                                        {{ Str::limit($post->title, 50) }}
                                    </a>
                                </h3>

                                <!-- Penulis & Tanggal -->
                                <div class="flex items-center text-sm text-gray-500 mb-3 space-x-4">
                                    <span>By {{ $post->author ?? 'Admin' }}</span>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>

                                <!-- Tautan Read More (Opsional: Tetap ada sebagai CTA) -->
                                <a href="{{ route('posts.show', $post) }}" class="text-yellow-500 hover:text-yellow-700 font-medium flex items-center space-x-1">
                                    <span>Read More</span>
                                    <!-- Ikon panah (menggunakan SVG inline) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-gray-50 p-6 rounded-xl shadow-md sticky top-4">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                    All Categories
                </h3>
                <ul class="space-y-2">
                    @foreach ($allCategories as $cat)
                        <li class="flex justify-between items-center">
                            <a href="{{ route('categories.show', $cat->id) }}"
                               class="text-gray-600 hover:text-yellow-600 truncate {{ $cat->id === $category->id ? 'font-bold text-yellow-600' : '' }}">
                                {{ $cat->name }}
                            </a>
                            <span class="bg-gray-200 text-xs px-2 py-0.5 rounded-full">
                                {{ $cat->posts_count }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection