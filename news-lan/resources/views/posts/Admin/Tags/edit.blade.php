@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.tags.index') }}" 
                   class="text-gray-600 hover:text-gray-900 inline-flex items-center text-sm mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Tags
                </a>
                <h2 class="text-3xl font-bold text-gray-800">Edit Tag</h2>
                <p class="text-gray-600 mt-2">Update informasi tag "#{{ $tag->name }}"</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tag Stats -->
                        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-blue-600 font-medium">Total Postingan</p>
                                        <p class="text-2xl font-bold text-blue-900">{{ $tag->posts()->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-green-600 font-medium">Dibuat Pada</p>
                                        <p class="text-sm font-bold text-green-900">{{ $tag->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Warning if tag has posts -->
                        @if($tag->posts()->count() > 0)
                            <div class="mb-6 p-4 bg-yellow-50 rounded-lg border border-yellow-300">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-yellow-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="text-sm text-yellow-800">
                                        <p class="font-semibold mb-1">Perhatian!</p>
                                        <p>Tag ini sedang digunakan oleh <strong>{{ $tag->posts()->count() }}</strong> postingan. Mengubah nama akan mempengaruhi semua postingan tersebut.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Nama Tag -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Tag <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-lg font-semibold">#</span>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $tag->name) }}"
                                       placeholder="Technology, Sports, Breaking News"
                                       required
                                       class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                            <div class="flex items-center space-x-2">
                                <span class="px-4 py-2 bg-yellow-500 text-gray-900 rounded-lg font-semibold text-sm inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    </svg>
                                    <span id="tagPreview">{{ $tag->name }}</span>
                                </span>
                                <span class="text-sm text-gray-500">Begini tampilan tag di website</span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                            <a href="{{ route('admin.tags.index') }}" 
                               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-gray-900 rounded-lg font-bold transition-colors inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Section -->
            @if($tag->posts()->count() === 0)
                <div class="mt-6 bg-red-50 overflow-hidden shadow-sm sm:rounded-lg border-2 border-red-200">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-red-900 mb-2">Zona Bahaya</h3>
                        <p class="text-sm text-red-700 mb-4">Tag ini tidak digunakan oleh postingan manapun. Anda dapat menghapusnya dengan aman.</p>
                        <form action="{{ route('admin.tags.destroy', $tag) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus tag #{{ $tag->name }}? Tindakan ini tidak dapat dibatalkan!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg transition-colors inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Tag Permanen
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Live Preview Script -->
    <script>
        document.getElementById('name').addEventListener('input', function(e) {
            const preview = document.getElementById('tagPreview');
            preview.textContent = e.target.value || '{{ $tag->name }}';
        });
    </script>
@endsection