@extends('layouts.app')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 border-b-4 border-yellow-500 pb-3 inline-block">
            All News Categories
        </h1>

        @if($categories->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Information</p>
                <p>No categories have been created yet, or they contain no published posts.</p>
            </div>
        @else
            <!-- Responsive Grid for Categories -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    {{-- Di sini, variabel $category (singular) sudah terdefinisi di dalam loop --}}
                    <a href="{{ route('categories.show', $category->id) }}"
                        class="block bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] overflow-hidden group">

                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 group-hover:text-yellow-600 transition-colors mb-2">
                                {{ $category->name }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                Total Posts:
                                <span class="font-semibold text-gray-700">
                                    {{ $category->posts_count }}
                                </span>
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-yellow-500 font-medium text-sm border-b border-yellow-500">
                                    View Articles
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400 group-hover:text-yellow-600 transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>


@endsection