<!-- FOOTER START -->
<footer class="bg-gray-900 text-gray-400 pt-16 pb-8">
  <div class="container mx-auto px-4">
    <!-- Grid 4 kolom -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
      
      <!-- 1. GET IN TOUCH -->
      <div>
        <h3 class="text-xl font-bold text-white uppercase mb-6 tracking-wide">Get In Touch</h3>
        <div class="space-y-4">
          <p class="flex items-start">
            <i class="fas fa-map-marker-alt w-5 mr-3 mt-1 text-yellow-500"></i>
            <span>123 Kebon Toge, Bandung City, Indonesia</span>
          </p>
          <p class="flex items-start">
            <i class="fas fa-phone-alt w-5 mr-3 mt-1 text-yellow-500"></i>
            <span>+62 8953 3274 0062</span>
          </p>
          <p class="flex items-start">
            <i class="fas fa-envelope w-5 mr-3 mt-1 text-yellow-500"></i>
            <span class="break-all">newslan@gmail.com</span>
          </p>
        </div>
        <h4 class="text-lg font-bold text-white uppercase mt-8 mb-4 tracking-wide">Follow Us</h4>
        <div class="flex space-x-2">
          <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-yellow-500 text-white hover:text-gray-900 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-yellow-500 text-white hover:text-gray-900 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-yellow-500 text-white hover:text-gray-900 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-yellow-500 text-white hover:text-gray-900 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-yellow-500 text-white hover:text-gray-900 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>

      <!-- 2. POPULAR NEWS -->
      <div>
        <h3 class="text-xl font-bold text-white uppercase mb-6 tracking-wide">Popular News</h3>
        <div class="space-y-5">
          
          @if(isset($popularFooterPosts) && $popularFooterPosts->isNotEmpty())
            @foreach($popularFooterPosts as $post)
              <div class="flex items-start">
                <!-- FIX: Gunakan thumbnail yang ada di database -->
                @if($post->thumbnail)
                  <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                       alt="{{ $post->title }}" 
                       class="w-24 h-16 object-cover rounded mr-4">
                @else
                  <div class="w-24 h-16 bg-gray-700 rounded mr-4 flex items-center justify-center">
                    <i class="fas fa-image text-gray-500"></i>
                  </div>
                @endif
                
                <div class="flex-1">
                  {{-- FIX: Gunakan $post langsung, bukan $post->slug --}}
                  <a href="{{ route('posts.show', $post) }}" class="text-white hover:text-yellow-500 transition-colors font-semibold leading-snug block mb-1">
                    {{ Str::limit($post->title, 50) }}
                  </a>
                  <span class="text-xs text-gray-500">
                    <i class="far fa-calendar mr-1"></i>
                    {{ $post->created_at->format('M d, Y') }}
                  </span>
                </div>
              </div>
            @endforeach
          @else
            <p class="text-gray-500">Belum ada berita populer.</p>
          @endif

        </div>
      </div>

      <!-- 3. TAGS -->
      <div>
        <h3 class="text-xl font-bold text-white uppercase mb-6 tracking-wide">Tags</h3>
        <div class="flex flex-wrap gap-2">
          
          @if(isset($footerTags) && $footerTags->isNotEmpty())
            @foreach($footerTags as $tag)
              <a href="{{ route('tags.show', $tag->name) }}" class="bg-gray-700 text-gray-300 text-sm font-medium px-4 py-2 rounded-md hover:bg-yellow-500 hover:text-gray-900 transition-colors">
                {{ $tag->name }}
              </a>
            @endforeach
          @else
            <p class="text-gray-500">Belum ada tag.</p>
          @endif

        </div>
      </div>

      <!-- 4. FLICKR PHOTOS -->
      <div>
        <h3 class="text-xl font-bold text-white uppercase mb-6 tracking-wide">Flickr Photos</h3>
        <div class="grid grid-cols-3 gap-2">
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
          <a href="#" class="block rounded overflow-hidden hover:opacity-80 transition-opacity">
            <img src="https://placehold.co/100x100/555/eee?text=Photo" alt="Placeholder" class="w-full h-auto object-cover">
          </a>
        </div>
      </div>

    </div>
    
    <!-- Garis Pemisah -->
    <div class="border-t border-gray-700 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center text-sm">
        <p class="mb-4 md:mb-0">
          &copy; <a href="{{ route('home') }}" class="text-white hover:text-yellow-500">LannnNews</a>. All Rights Reserved.
        </p>
      </div>
    </div>

  </div>

  <!-- Tombol Back to Top -->
  <a href="#" id="back-to-top" class="fixed bottom-6 right-6 bg-yellow-500 w-12 h-12 rounded-full flex items-center justify-center text-gray-900 hover:bg-yellow-400 transition-colors shadow-lg z-50 opacity-0 pointer-events-none">
    <i class="fas fa-arrow-up text-lg"></i>
  </a>
</footer>
<!-- FOOTER END -->

<!-- JavaScript untuk Back to Top -->
<script>
  const backToTopButton = document.getElementById('back-to-top');

  if (backToTopButton) {
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add('opacity-100', 'pointer-events-auto');
        backToTopButton.classList.remove('opacity-0', 'pointer-events-none');
      } else {
        backToTopButton.classList.add('opacity-0', 'pointer-events-none');
        backToTopButton.classList.remove('opacity-100', 'pointer-events-auto');
      }
    });

    backToTopButton.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
</script>