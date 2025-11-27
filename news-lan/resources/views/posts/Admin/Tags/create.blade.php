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
                <h2 class="text-3xl font-bold text-gray-800">Tambah Tag Baru</h2>
                <p class="text-gray-600 mt-2">Buat tag baru untuk menandai postingan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.tags.store') }}" method="POST">
                        @csrf

                        <!-- Info Box -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm text-blue-800">
                                    <p class="font-semibold mb-1">Tips Membuat Tag:</p>
                                    <ul class="list-disc list-inside space-y-1 text-blue-700">
                                        <li>Gunakan nama pendek dan deskriptif (contoh: "Football", "AI", "Breaking News")</li>
                                        <li>Hindari spasi, gunakan huruf kapital atau tanda hubung jika perlu</li>
                                        <li>Tag akan ditampilkan dengan prefix "#" di website</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

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
                                       value="{{ old('name') }}"
                                       placeholder="Technology, Sports, Breaking News"
                                       required
                                       class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-lightbulb mr-1"></i>
                                Contoh tag populer: Technology, Sports, Entertainment, Politics, Health
                            </p>
                        </div>

                        <!-- Preview -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                            <div class="flex items-center space-x-2">
                                <span class="px-4 py-2 bg-yellow-500 text-gray-900 rounded-lg font-semibold text-sm inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    </svg>
                                    <span id="tagPreview">YourTagName</span>
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
                                Simpan Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Preview Script -->
    <script>
        document.getElementById('name').addEventListener('input', function(e) {
            const preview = document.getElementById('tagPreview');
            preview.textContent = e.target.value || 'YourTagName';
        });
    </script>
@endsection