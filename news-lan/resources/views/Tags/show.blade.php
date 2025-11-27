@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Konten Utama Tag -->
            <div class="lg:col-span-2">

                <!-- Judul Tag dan Link View All Tags -->
                <div class="flex justify-between items-center mb-6 border-b border-yellow-500 pb-3">
                    <h2 class="text-2xl font-bold text-gray-800 uppercase">
                        TAG: #{{ $tag->name }}
                    </h2>
                    <a href="{{ route('tags.index') }}" class="text-sm text-gray-600 hover:text-gray-700 font-semibold">
                        View All Tags
                    </a>
                </div>

                <!-- Daftar Berita dengan Tag Ini -->
                @if($posts->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($posts as $post)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transform hover:shadow-xl transition duration-300">

                                {{-- FIX: Gunakan $post langsung, bukan $post->slug --}}
                                <a href="{{ route('posts.show', $post) }}" class="block relative h-48 bg-gray-200">
                                    @if($post->thumbnail)
                                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-500">No Image</div>
                                    @endif

                                    <!-- Overlay Kategori -->
                                    @if($post->category)
                                        <span
                                            class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </a>

                                <!-- Detail Postingan -->
                                <div class="p-4">
                                    <p class="text-xs text-gray-500 mb-2">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </p>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 hover:text-yellow-600 transition-colors">
                                        {{-- FIX: Gunakan $post langsung, bukan $post->slug --}}
                                        <a href="{{ route('posts.show', $post) }}">
                                            {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="bg-gray-100 p-6 text-center rounded-lg text-gray-600">
                        Belum ada berita dengan tag #{{ $tag->name }} yang dipublikasikan.
                    </div>
                @endif
            </div>

            <!-- Sidebar Kanan (Sama seperti Categories Show) -->
            <div class="lg:col-span-1 space-y-8">


                <!-- Widget Daftar Semua Kategori -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2 uppercase">
                        All Tags
                    </h3>
                    <ul class="space-y-2">
                        @foreach($allCategories as $cat)
                            <li class="border-b last:border-b-0 border-gray-100">
                                <a href="{{ route('categories.show', $cat) }}"
                                    class="flex justify-between items-center py-2 text-gray-700 hover:text-yellow-600 font-medium">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-xs font-normal text-gray-500">{{ $cat->posts_count ?? '0' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Widget Iklan -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h3 class="text-xl font-bold p-4 border-b">Advertisement</h3>
                    <div class="p-4">
                        <div class="aspect-[3/4] w-full overflow-hidden rounded-lg">
                            <img src="{{ asset('assets/img/biann.jpeg') }}" alt="bian" class="w-full h-[500px] object-cover">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection