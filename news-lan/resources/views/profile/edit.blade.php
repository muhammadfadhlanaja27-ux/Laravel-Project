@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Custom Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <!-- User Icon -->
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Profil Pengguna</h1>
                        <p class="text-gray-600">Kelola informasi akun, kata sandi, dan privasi Anda dengan aman.</p>
                    </div>
                </div>
            </div>

            <!-- Bagian Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Bagian Update Password -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bagian Delete User -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl border border-red-100">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>


@endsection