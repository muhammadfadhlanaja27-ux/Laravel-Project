@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Postingan</h1>
                    <p class="text-gray-600">Perbarui konten, kategori, dan tag untuk Post ID: {{ $post->id }}</p>
                </div>
            </div>
        </div>

        <!-- Form Edit Post -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden p-8">

            <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Postingan</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-shadow">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                    <textarea name="content" id="content" rows="10" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-shadow">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-shadow">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags (Menggunakan Checkbox Grid) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Tags (Pilih yang sesuai)
                        </span>
                    </label>
                    @php
                        // Mendapatkan ID tag yang sudah terpasang di postingan ini
                        $currentTags = $post->tags->pluck('id')->toArray();
                        // Menggabungkan tag yang sudah ada dengan input lama jika ada error validasi
                        $checkedTags = old('tags', $currentTags);
                    @endphp
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach ($tags as $tag)
                            <label
                                class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 cursor-pointer transition 
                                       @if(in_array($tag->id, $checkedTags)) bg-green-50 border-green-400 shadow-md @endif">
                                <input type="checkbox" 
                                    name="tags[]" 
                                    value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $checkedTags) ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 rounded focus:ring-2 focus:ring-green-500">
                                <span class="text-sm text-gray-700 font-medium">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('tags')
                        <p class="mt-3 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Current Thumbnail and New Thumbnail -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Saat Ini</label>
                        @if ($post->thumbnail)
                            {{-- Pastikan path asset() sudah benar sesuai konfigurasi storage Anda --}}
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current Thumbnail"
                                class="w-full h-32 object-cover rounded-lg shadow-md border border-gray-200">
                        @else
                            <div
                                class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500 rounded-lg border border-dashed border-gray-300">
                                Tidak ada thumbnail saat ini.
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Ganti
                            Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti.</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition shadow-xl transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>


@endsection