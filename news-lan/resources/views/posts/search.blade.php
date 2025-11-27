@extends('layouts.app')
@section('content')

  <div class="container mx-auto px-4 py-8">

    <!-- Header Hasil Pencarian & Tombol Kembali -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 border-b pb-4">
      <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-1">
          Search Results for: <span class="text-yellow-500">"{{ $query }}"</span>
        </h2>
        <p class="text-gray-600">
          Found {{ $posts->total() }} {{ Str::plural('result', $posts->total()) }}
        </p>
      </div>

      <!-- Tombol "Kembali ke Halaman Awal" (New Feature) -->
      <a href="{{ route('home') }}"
        class="mt-4 md:mt-0 inline-flex items-center bg-gray-800 text-white font-medium px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-md">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        </svg>
        Back to Home
      </a>
    </div>

    @if($posts->count())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
          <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:shadow-xl transition duration-300">

            <!-- Thumbnail -->
            <a href="{{ route('posts.show', $post) }}" class="block relative h-48 bg-gray-200 group">
              @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              @else
                <div class="w-full h-full flex items-center justify-center text-gray-500">
                  <i class="fas fa-image text-4xl"></i>
                </div>
              @endif

              <!-- Category Badge -->
              @if($post->category)
                <span
                  class="absolute top-0 left-0 bg-yellow-500 text-gray-900 font-bold uppercase text-xs px-3 py-1 rounded-br-lg">
                  {{ $post->category->name }}
                </span>
              @endif
            </a>

            <!-- Post Details -->
            <div class="p-4">
              <p class="text-xs text-gray-500 mb-2">
                <i class="far fa-calendar mr-1"></i>
                {{ $post->created_at->format('M d, Y') }}
              </p>

              <h3 class="text-xl font-bold text-gray-800 mb-2 hover:text-yellow-600 transition-colors">
                <a href="{{ route('posts.show', $post) }}">
                  {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                </a>
              </h3>

              <p class="text-gray-600 text-sm mb-3">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
              </p>

              <!-- Tags -->
              @if($post->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2 mt-3">
                  @foreach($post->tags->take(3) as $tag)
                    <a href="{{ route('tags.show', $tag->name) }}"
                      class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded hover:bg-yellow-500 hover:text-gray-900 transition-colors">
                      #{{ $tag->name }}
                    </a>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-8">
        {{ $posts->links() }}
      </div>
    @else
      <!-- No Results Found -->
      <div class="bg-gray-100 rounded-lg p-12 text-center">
        <i class="fas fa-search text-6xl text-gray-400 mb-4"></i>
        <h3 class="text-2xl font-bold text-gray-700 mb-2">No Results Found</h3>
        <p class="text-gray-600 mb-6">
          We couldn't find any posts matching "<strong>{{ $query }}</strong>"
        </p>
      </div>
    @endif

    <!-- Search Tips -->
    <div class="mt-12 bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
      <h4 class="font-bold text-blue-900 mb-2">
        <i class="fas fa-lightbulb mr-2"></i>
        Search Tips:
      </h4>
      <ul class="text-blue-800 text-sm space-y-1 list-disc list-inside">
        <li>Try using different keywords</li>
        <li>Search by category name (e.g., "Technology", "Sports")</li>
        <li>Search by tag name (e.g., "Football", "AI")</li>
        <li>Use more general terms for broader results</li>
      </ul>
    </div>

  </div>
@endsection