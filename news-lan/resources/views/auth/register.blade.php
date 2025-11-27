<x-guest-layout>
{{-- CATATAN: Pastikan guest-layout.blade.php juga menggunakan min-h-screen --}}
<div class="bg-white min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-sm mx-auto"> {{-- Diubah ke max-w-sm untuk lebih kecil sedikit --}}
        <!-- Logo -->
        <div class="text-center mb-4">
            {{-- Ukuran Font dikurangi menjadi 5xl untuk menghemat ruang vertikal --}}
            <h1 class="text-5xl font-extrabold tracking-tight mb-1">
                <span class="text-gray-800">Lannn</span>
                <span class="text-yellow-500">News</span>
            </h1>
        </div>

        <!-- Card -->
        <div class="bg-gradient-to-br from-gray-700 to-gray-900 rounded-2xl shadow-2xl p-6"> {{-- Padding dikurangi dari p-8 ke p-6 --}}
            
            <!-- Icon Circle -->
            <div class="flex justify-center mb-5">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg"> {{-- Ukuran ikon dikurangi --}}
                    <i class="fas fa-user-plus text-gray-700 text-2xl"></i> {{-- Ukuran ikon dikurangi --}}
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-white text-2xl font-bold text-center mb-2">Register</h2> {{-- Ukuran Title dikurangi --}}
            <p class="text-gray-200 text-center text-xs mb-6">Create your account to get started!</p> {{-- Ukuran teks dikurangi --}}

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4"> {{-- Spacing dikurangi dari space-y-5 ke space-y-4 --}}
                @csrf

                <!-- Name Input -->
                <div>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Full Name"
                        required 
                        autofocus 
                        autocomplete="name"
                        class="w-full px-3 py-2 text-sm bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('name')
                        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Email"
                        required 
                        autocomplete="username"
                        class="w-full px-3 py-2 text-sm bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <input 
                        id="password" 
                        type="password" 
                        name="password"
                        placeholder="Password"
                        required 
                        autocomplete="new-password"
                        class="w-full px-3 py-2 text-sm bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('password')
                        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        required 
                        autocomplete="new-password"
                        class="w-full px-3 py-2 text-sm bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                {{-- KOLOM BARU: KODE KHUSUS ADMIN --}}
                <div>
                    <input 
                        id="admin_code" 
                        type="text" 
                        name="admin_code" 
                        placeholder="Kode Admin"
                        value="{{ old('admin_code') }}"
                        required {{-- <--- PERUBAHAN DI SINI: Ditambahkan atribut required --}}
                        autocomplete="off"
                        class="w-full px-3 py-2 text-sm bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all"
                    />
                    {{-- CATATAN: Untuk membuat kode "untukadmin" berfungsi, Anda perlu memvalidasi 
                         nilai input 'admin_code' di server Laravel Anda, 
                         misalnya di RegisterController atau Request Anda. Di sisi front-end, ini WAJIB diisi. --}}
                    @error('admin_code')
                        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Register Button -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-800 text-white font-bold py-2 rounded-lg hover:from-yellow-700 hover:to-yellow-600 transform hover:scale-[1.02] transition-all duration-200 shadow-lg mt-5" {{-- Ukuran tombol lebih kecil --}}
                >
                    Register
                </button>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-gray-200 text-xs">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-white font-semibold hover:text-green-400 transition-colors">
                            Login here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 text-xs flex items-center justify-center gap-1 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
    </div>

</div>
</x-guest-layout>