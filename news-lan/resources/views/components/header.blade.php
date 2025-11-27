<!-- HEADER START -->
<header class="bg-white shadow-md">
  <!-- TOP BAR -->
  <div class="bg-gray-800 text-gray-400 text-xs py-2 hidden md:block border-b border-gray-700">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <div class="flex space-x-4">
        <span>Monday, January 1, 2045</span>
        <a href="#" class="hover:text-white transition-colors">|</a>
        <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
      </div>
      <div class="flex space-x-3">
        <a href="#" class="hover:text-blue-500 transition-colors"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-pink-600 transition-colors"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-red-600 transition-colors"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="hover:text-red-700 transition-colors"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <!-- LOGO -->
  <div class="container mx-auto px-4 py-4 text-left">
    <h1 class="text-6xl font-extrabold tracking-tight">
      <span class="text-gray-800">Lannn</span>
      <span class="text-yellow-500">News</span>
    </h1>
  </div>

  <!-- NAVIGATION -->
  <nav class="bg-gray-800 text-white shadow-xl">
    <div class="container mx-auto px-4">
      <!-- Desktop & Mobile Top Bar -->
      <div class="flex justify-between items-center h-14">
        
        <!-- Menu Kiri (Home + Desktop Links) -->
        <div class="flex items-center space-x-1">
          <!-- Home (Selalu Tampil) -->
          <a href="{{ route('home') }}"
            class="text-white font-bold uppercase text-sm px-6 flex items-center h-14 transition-colors {{ request()->routeIs('home') || request()->routeIs('posts.index') ? 'bg-yellow-500 text-gray-900 hover:bg-yellow-400' : 'hover:bg-gray-700' }}">
            Home
          </a>
          
          <!-- Desktop-Only Links (Category & Tags) -->
          <div class="hidden md:flex items-center space-x-1 h-14">
            <a href="{{ route('categories.index') }}"
              class="text-white font-bold uppercase text-sm px-4 flex items-center h-full transition-colors {{ request()->routeIs('categories.index') || request()->routeIs('categories.show') ? 'bg-yellow-500 text-gray-900 hover:bg-yellow-400' : 'hover:bg-gray-700' }}">
              Category
            </a>
            
            <!-- Dropdown Tags (Desktop) -->
            <div class="relative group h-full">
              @php
                $isTagsActive = request()->routeIs('tags.index') || request()->routeIs('tags.show');
              @endphp
              <button class="font-bold uppercase text-sm px-4 h-full flex items-center transition-colors {{ $isTagsActive ? 'bg-yellow-500 text-gray-900 hover:bg-yellow-400' : 'hover:bg-gray-700' }}">
                Tags
                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <!-- Dropdown Content -->
              <div class="absolute hidden group-hover:block bg-gray-700 text-white shadow-lg z-20 min-w-[200px] rounded-b-md">
                @if($popularTags->isNotEmpty())
                  @foreach($popularTags as $tag)
                    <a href="{{ route('tags.show', $tag->name) }}" class="block px-4 py-2 text-sm hover:bg-gray-600 transition-colors">
                      #{{ $tag->name }} ({{ $tag->posts_count }})
                    </a>
                  @endforeach
                @else
                  <span class="block px-4 py-2 text-sm text-gray-400">Belum ada tag populer.</span>
                @endif
                <div class="border-t border-gray-600">
                  <a href="{{ route('tags.index') }}" class="block px-4 py-2 text-sm bg-gray-600 hover:bg-gray-500 transition-colors font-semibold">
                    Lihat Semua Tags
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Menu Kanan (Search + Mobile Button) -->
        <div class="flex items-center">
          <!-- Search Form - Disesuaikan untuk mobile -->
          <form action="{{ route('posts.search') }}" method="GET" class="flex items-center">
            <input type="text" name="q" placeholder="Search..." required
              value="{{ request('q') }}"
              class="py-2 px-3 h-9 text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 w-40 md:w-64 transition-all duration-300 ease-in-out">
            <button type="submit"
              class="bg-yellow-500 h-9 w-10 flex items-center justify-center hover:bg-yellow-400 transition-colors">
              <svg class="w-4 h-4 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </form>

          <!-- Mobile Menu Button (Hamburger) -->
          <button id="mobile-menu-button" class="md:hidden ml-3 p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="sr-only">Open main menu</span>
            <!-- Icon "garis 3" (hamburger) -->
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Menu Panel (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-700 border-t border-gray-600">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Link Mobile Disederhanakan -->
        <a href="{{ route('categories.index') }}"
          class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('categories.index') || request()->routeIs('categories.show') ? 'bg-gray-900 text-white' : '' }}">
          Category
        </a>
        <a href="{{ route('tags.index') }}"
          class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('tags.index') || request()->routeIs('tags.show') ? 'bg-gray-900 text-white' : '' }}">
          All Tags
        </a>
        
        <!-- Opsional: Tampilkan beberapa tag populer di menu mobile -->
        @if($popularTags->isNotEmpty())
          <div class="px-3 pt-3 pb-1">
            <span class="text-xs text-gray-400 font-semibold uppercase">Popular Tags</span>
          </div>
          @foreach($popularTags->take(5) as $tag) <!-- Ambil 5 saja untuk mobile -->
            <a href="{{ route('tags.show', $tag->name) }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-sm">
              #{{ $tag->name }}
            </a>
          @endforeach
        @endif
      </div>
    </div>
  </nav>
</header>
<!-- HEADER END -->

<!-- JavaScript untuk toggle menu mobile -->
<!-- Pastikan ini diletakkan sebelum tag </body> penutup, atau di dalam <head> jika perlu -->
<script>
  // Cek jika elemennya ada sebelum menambahkan event listener
  const menuButton = document.getElementById('mobile-menu-button');
  const menu = document.getElementById('mobile-menu');

  if (menuButton && menu) {
    menuButton.addEventListener('click', function() {
      menu.classList.toggle('hidden');
    });
  }
</script>