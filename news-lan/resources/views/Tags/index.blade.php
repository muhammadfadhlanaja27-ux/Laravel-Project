@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold text-gray-800 uppercase border-b-4 border-yellow-500 pb-2 mb-8">
            Daftar Semua Tag (Label)
        </h1>

        @if(isset($tags) && $tags->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                
                @foreach($tags as $tag)
                    <!-- Kartu Tag -->
                    <a href="{{ route('tags.show', $tag->name) }}" 
                       class="block bg-white rounded-xl shadow-lg p-4 text-center transition duration-300 transform hover:scale-105 hover:shadow-xl hover:ring-2 hover:ring-yellow-500">
                        
                        <div class="mb-3 text-3xl text-yellow-600">
                            <!-- Icon Label -->
                            <i class="fas fa-tag"></i> 
                        </div>

                        <!-- Nama Tag -->
                        <h2 class="text-lg font-extrabold text-gray-900 uppercase truncate mb-1">
                            #{{ $tag->name }}
                        </h2>

                        <!-- Jumlah Postingan -->
                        <p class="text-xs text-gray-600 font-semibold">
                            {{ $tag->posts_count ?? 0 }} {{ $tag->posts_count == 1 ? 'Berita' : 'Berita' }}
                        </p>
                    </a>
                @endforeach

            </div>
        @else
            <div class="bg-gray-200 p-8 text-center rounded-lg shadow-md">
                <p class="text-xl text-gray-700 font-medium">
                    Belum ada Tag (Label) yang tersedia saat ini.
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    Tag akan otomatis muncul setelah ditambahkan ke berita.
                </p>
            </div>
        @endif
    </div>


@endsection