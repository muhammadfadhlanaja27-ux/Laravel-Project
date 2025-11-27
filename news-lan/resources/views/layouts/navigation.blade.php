<nav x-data="{ sidebarOpen: true }" class="relative">
    <!-- Top Navigation Bar -->
    <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 shadow-lg fixed top-0 left-0 right-0 z-40">
        <div class="flex justify-between items-center h-16 px-6">
            <!-- Hamburger Menu -->
            <button @click="sidebarOpen = !sidebarOpen" class="text-white hover:bg-yellow-500 p-2 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                <button class="text-white hover:bg-yellow-500 p-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                
                <button class="text-white hover:bg-yellow-500 p-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </button>

                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <div class="text-white font-semibold text-sm">{{ Auth::user()->name }}</div>
                        <div class="text-yellow-200 text-xs">Administrator</div>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=fff&color=2563eb" 
                         class="w-10 h-10 rounded-full border-2 border-white shadow-md" 
                         alt="Profile">
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed left-0 top-0 h-full w-64 bg-gray-900 text-white shadow-2xl transform transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
        
        <!-- Logo Section -->
        <div class="flex items-center justify-center h-20 border-b border-gray-800 bg-gray-950">
            <h1 class="text-2xl font-bold">
                <span class="text-white">Lannn</span>
                <span class="text-yellow-400">News</span>
            </h1>
        </div>

        <!-- Menu Items -->
        <div class="py-6 px-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('dashboard') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Tambah Berita -->
            <a href="{{ route('admin.posts.create') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.posts.create') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium">Tambah Berita</span>
            </a>

            <!-- BARU: Kelola Kategori -->
            <a href="{{ route('admin.categories.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span class="font-medium">Kelola Kategori</span>
            </a>

            <!-- BARU: Kelola Tags -->
            <a href="{{ route('admin.tags.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.tags.*') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span class="font-medium">Kelola Tags</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('profile.edit') ? 'bg-gray-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="font-medium">Profile</span>
            </a>
        </div>

        <!-- Logout Button (Bottom) -->
        <div class="absolute bottom-6 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="flex items-center justify-center space-x-3 w-full px-4 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="font-semibold">LOGOUT</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay untuk mobile -->
    <div @click="sidebarOpen = false" 
         x-show="sidebarOpen" 
         class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>
</nav>