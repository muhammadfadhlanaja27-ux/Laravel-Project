<x-guest-layout>
{{-- CATATAN: Pastikan guest-layout.blade.php juga menggunakan min-h-screen --}}
<div class="bg-white min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-6xl font-extrabold tracking-tight mb-2">
                <span class="text-gray-800">Lannn</span>
                <span class="text-yellow-500">News</span>
            </h1>
        </div>

        <!-- Card -->
        <div class="bg-gradient-to-br from-gray-700 to-gray-900 rounded-3xl shadow-2xl p-8">
            
            <!-- Icon Circle (Diubah dari user-plus menjadi newspaper) -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-newspaper text-gray-700 text-3xl"></i>
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-white text-3xl font-bold text-center mb-2">Sign in</h2>
            <p class="text-gray-200 text-center text-sm mb-8">Sign in and start managing your news!</p>

            <!-- Session Status (Ditambahkan untuk pesan status, misalnya setelah reset password) -->
            <x-auth-session-status class="mb-4 text-green-300" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Hapus Name dan Confirm Password untuk Login --}}

                <!-- Email Input -->
                <div>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Email"
                        required 
                        autofocus 
                        autocomplete="username"
                        class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
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
                        autocomplete="current-password"
                        class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me & Forgot Password Link -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="flex items-center text-gray-200 cursor-pointer">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="w-4 h-4 rounded border-gray-600 bg-gray-800/50 text-yellow-500 focus:ring-2 focus:ring-yellow-400 cursor-pointer"
                        />
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-gray-300 hover:text-white transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>


                <!-- Login Button (Diubah dari Register) -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-800 text-white font-bold py-3 rounded-xl hover:from-yellow-700 hover:to-yellow-600 transform hover:scale-[1.02] transition-all duration-200 shadow-lg mt-6"
                >
                    Login
                </button>

                <!-- Register Link (Diubah dari Login) -->
                <div class="text-center mt-6">
                    <p class="text-gray-200 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-white font-semibold hover:text-green-400 transition-colors">
                            Register here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 text-sm flex items-center justify-center gap-2 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
    </div>

</div>
</x-guest-layout>