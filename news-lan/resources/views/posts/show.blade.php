@extends('layouts.app')
@section('content')

    <div class="container mx-auto max-w-6xl px-4 py-8 md:py-12">

        <!-- Struktur Konten Utama -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">

            <!-- Thumbnail -->
            @if($post->thumbnail)
                <div class="relative w-full h-80 md:h-96 bg-gray-200">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                        class="w-full h-full object-cover">

                    <!-- Overlay untuk Kategori -->
                    @if($post->category)
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-yellow-500 text-gray-900 font-bold uppercase text-xs px-3 py-1 rounded-br-lg">
                                {{ $post->category->name }}
                            </span>
                        </div>
                    @endif
                </div>
            @endif

            <div class="p-6 md:p-10">

                <!-- Judul Utama -->
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Info Tambahan / Metadata -->
                <div class="text-sm text-gray-500 mb-8 border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <!-- Penulis -->
                        <span>
                            <i class="fas fa-user mr-1"></i>
                            Oleh <strong class="text-gray-700">{{ $post->author ?? 'Admin' }}</strong>
                        </span>
                        <span class="text-gray-400">|</span>
                        <!-- Tanggal -->
                        <span>
                            <i class="far fa-calendar mr-1"></i>
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                        <span class="text-gray-400">|</span>
                        <!-- Jumlah Komentar -->
                        <span>
                            <i class="far fa-comments mr-1"></i>
                            {{ $post->approvedComments->count() }}
                            {{ Str::plural('Comment', $post->approvedComments->count()) }}
                        </span>
                    </div>
                </div>

                <!-- Isi Berita -->
                <article class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
                    <div class="text-lg">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </article>

                <!-- Tag -->
                @if($post->tags->count() > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <strong class="text-gray-700 text-sm uppercase tracking-wider">
                            <i class="fas fa-tags mr-2"></i>Tags:
                        </strong>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->name) }}"
                                    class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full hover:bg-yellow-500 hover:text-gray-900 transition-colors">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- SECTION KOMENTAR (BARU) -->
                <div class="mt-12 pt-8 border-t-2 border-gray-200">

                    <!-- Header Komentar -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            <i class="far fa-comments mr-2 text-yellow-500"></i>
                            Comments ({{ $post->approvedComments->count() }})
                        </h2>
                    </div>

                    <!-- Alert Success -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Form Komentar -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Leave a Comment</h3>

                        <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Jika user BELUM login, tampilkan input Name & Email -->
                            @guest
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                            placeholder="Your name" />
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                            placeholder="your@email.com" />
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endguest

                            <!-- Jika user SUDAH login, tampilkan info -->
                            @auth
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                    <p class="text-sm text-blue-700">
                                        <i class="fas fa-user-circle mr-2"></i>
                                        Commenting as <strong>{{ Auth::user()->name }}</strong>
                                    </p>
                                </div>
                            @endauth

                            <!-- Comment Textarea -->
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Comment <span class="text-red-500">*</span>
                                </label>
                                <textarea id="comment" name="comment" rows="5" required maxlength="1000"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent resize-none"
                                    placeholder="Write your comment here...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Maximum 1000 characters</p>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Your comment will be reviewed before publishing
                                </p>
                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-6 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Daftar Komentar -->
                    @if($post->approvedComments->count() > 0)
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                All Comments ({{ $post->approvedComments->count() }})
                            </h3>

                            @foreach($post->approvedComments as $comment)
                                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-4 flex-1">
                                            <!-- Avatar -->
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                    {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                                                </div>
                                            </div>

                                            <!-- Comment Content -->
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <span class="font-semibold text-gray-900">
                                                        {{ $comment->author_name }}
                                                    </span>
                                                    <span class="text-gray-400">•</span>
                                                    <span class="text-sm text-gray-500">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-700 leading-relaxed">
                                                    {{ $comment->comment }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Delete Button (hanya untuk pemilik comment atau admin) -->
                                        @auth
                                            @if(Auth::id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors ml-4"
                                                        title="Delete comment">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No Comments Yet -->
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <i class="far fa-comment-dots text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600 text-lg">No comments yet. Be the first to comment!</p>
                        </div>
                    @endif
                </div>
                <!-- END SECTION KOMENTAR -->

                <!-- Tombol Kembali -->
                <div class="mt-10">
                    <a href="{{ route('posts.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Berita Lainnya
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection