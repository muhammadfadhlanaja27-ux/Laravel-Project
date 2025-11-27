@extends('layouts.app')
@section('content')

  <div class="container mx-auto my-8 p-4">

    @if($posts->count() >= 5)
      @php
        // [--- DIUBAH ---]
        // $tags hardcode dihapus, karena $tags sekarang dikirim dari PostController

        $featuredPost = $posts->first();
        $sidePostsTop = $posts->skip(1)->take(2);
        $sidePostsBottom = $posts->skip(3)->take(2);
        $remainingPosts = $posts->skip(5);

        // Data trending masih bisa kita ambil dari $posts
        $trendingPosts = $sidePostsTop->concat($sidePostsBottom)->concat($remainingPosts->take(1));
      @endphp

      <!-- BAGIAN FEATURED (SESUAI GAMBAR) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Kolom Kiri: Berita Utama (Featured) -->
        <div class="lg:col-span-2 relative rounded-lg overflow-hidden shadow-lg">
          <a href="{{ route('posts.show', $featuredPost) }}" class="block">
            @if($featuredPost->thumbnail)
              <img src="{{ asset('storage/' . $featuredPost->thumbnail) }}" alt="{{ $featuredPost->title }}"
                class="w-full h-[450px] object-cover transition-transform duration-300 ease-in-out hover:scale-105">
            @else
              <div class="w-full h-[450px] bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
              </div>
            @endif

            <!-- Overlay Konten -->
            <div
              class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black via-black/70 to-transparent text-white">
              @if($featuredPost->category)
                <span
                  class="bg-yellow-600 text-white text-xs font-bold uppercase px-3 py-1 rounded mb-2 inline-block">{{ $featuredPost->category->name }}</span>
              @endif
              <span class="text-sm opacity-80 ml-2">{{ $featuredPost->created_at->format('d M Y') }}</span>
              <h2 class="text-2xl md:text-3xl font-bold mt-2 hover:text-yellow-300 transition-colors">
                {{ $featuredPost->title }}
              </h2>
            </div>
          </a>
        </div>

        <!-- Kolom Kanan: 4 Berita Kecil -->
        <div class="flex flex-col gap-6">
          <!-- Tumpukan 2 Berita Atas -->
          @foreach($sidePostsTop as $post)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex h-[140px]">
              <a href="{{ route('posts.show', $post) }}" class="w-1/3 block">
                @if($post->thumbnail)
                  <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                    class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-105">
                @else
                  <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500 text-sm">No Image</span>
                  </div>
                @endif
              </a>
              <div class="w-2/3 p-4 flex flex-col justify-between">
                <div>
                  @if($post->category)
                    <span
                      class="bg-yellow-600 text-white text-xs font-bold uppercase px-2 py-0.5 rounded mb-1 inline-block">{{ $post->category->name }}</span>
                  @endif
                  <span class="text-sm text-gray-500 ml-1">{{ $post->created_at->format('d M Y') }}</span>
                  <h3 class="text-base font-bold mt-1 leading-tight">
                    <a href="{{ route('posts.show', $post) }}" class="text-gray-900 hover:text-blue-600 transition-colors">
                      {{ \Illuminate\Support\Str::limit($post->title, 55) }}
                    </a>
                  </h3>
                </div>
              </div>
            </div>
          @endforeach

          <!-- Grid 2 Berita Bawah (jika ada) -->
          <div class="grid grid-cols-2 gap-6">
            @foreach($sidePostsBottom as $post)
              <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <a href="{{ route('posts.show', $post) }}" class="block">
                  @if($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                      class="w-full h-24 object-cover transition-transform duration-300 ease-in-out hover:scale-105">
                  @else
                    <div class="w-full h-24 bg-gray-200 flex items-center justify-center">
                      <span class="text-gray-500 text-sm">No Image</span>
                    </div>
                  @endif
                </a>
                <div class="p-3">
                  @if($post->category)
                    <span
                      class="bg-yellow-600 text-white text-xs font-bold uppercase px-2 py-0.5 rounded mb-1 inline-block">{{ $post->category->name }}</span>
                  @endif
                  <span class="text-sm text-gray-500 ml-1">{{ $post->created_at->format('d M Y') }}</span>
                  <h3 class="text-sm font-bold mt-1 leading-tight">
                    <a href="{{ route('posts.show', $post) }}" class="text-gray-900 hover:text-blue-600 transition-colors">
                      {{ \Illuminate\Support\Str::limit($post->title, 40) }}
                    </a>
                  </h3>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Breaking News Ticker (Statis) -->
      <div class="news-box"> <span class="label">Breaking News</span>
        <div class="marquee-wrap">
          <p class="marquee">Berita terkini : Terjadi lempar lemparan mbg di sekitar kelas ROTKP 5 dan ROTKP 4 oleh kelas
            RPL
          </p>
        </div>
      </div>


      <!-- BAGIAN KONTEN UTAMA (KIRI) DAN SIDEBAR (KANAN) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

        <!-- KOLOM KIRI: "BERITA TERBARU LAINNYA" -->
        <div class="lg:col-span-2">
          <h1 class="text-3xl font-bold text-gray-800 mb-8">Berita Terbaru Lainnya</h1>

          @if($remainingPosts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              @foreach ($remainingPosts as $post)
                <div
                  class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-2xl">
                  <!-- Thumbnail -->
                  <a href="{{ route('posts.show', $post) }}" class="block">
                    @if($post->thumbnail)
                      <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-48 object-cover"
                        alt="{{ $post->title }}">
                    @else
                      <div class="bg-gray-200 w-full h-48 flex items-center justify-center">
                        <p class="text-gray-500 mb-0">No Image</p>
                      </div>
                    @endif
                  </a>

                  <!-- Konten Card -->
                  <div class="p-5 flex flex-col flex-grow">
                    @if($post->category)
                      <span
                        class="bg-yellow-600 text-white text-sm font-semibold uppercase px-2.5 py-0.5 rounded mb-2 self-start">{{ $post->category->name }}</span>
                    @endif

                    <h5 class="text-lg font-bold text-gray-900 mb-2">
                      <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-700 transition-colors">
                        {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                      </a>
                    </h5>
                    <p class="text-gray-700 text-base mb-4">
                      {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                    </p>

                    <!-- Footer Card (termasuk tombol) -->
                    <div class="mt-auto border-t border-gray-100 pt-4">
                      <div class="flex justify-between items-center">
                        <small class="text-gray-500 text-sm">
                          Oleh: {{ $post->author ?? 'Admin' }} |
                          {{ $post->created_at->format('d M Y') }}
                        </small>
                        <a href="{{ route('posts.show', $post) }}"
                          class="text-sm text-blue-600 font-semibold hover:text-blue-800">
                          Baca Selengkapnya &rarr;
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-8">
              {{ $posts->links() }}
            </div>

          @else
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded text-center" role="alert">
              <p>Tidak ada berita terbaru lainnya saat ini.</p>
            </div>
          @endif
        </div>
        <!-- PENUTUP KOLOM KIRI -->


        <!-- KOLOM KKANAN: SIDEBAR BARU -->
        <aside class="lg:col-span-1">
          <div class="sticky top-8 space-y-6">

            <!-- WIDGET: FOLLOW US -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
              <h3 class="text-xl font-bold p-4 border-b">Follow Us</h3>
              <div class="p-4 space-y-3">
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                  <span>Facebook</span>
                  <strong>12,345 Fans</strong>
                </a>
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-sky-500 hover:bg-sky-600 transition-colors">
                  <span>Twitter</span>
                  <strong>12,345 Followers</strong>
                </a>
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-blue-700 hover:bg-blue-800 transition-colors">
                  <span>LinkedIn</span>
                  <strong>12,345 Connects</strong>
                </a>
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-pink-600 hover:bg-pink-700 transition-colors">
                  <span>Instagram</span>
                  <strong>12,345 Followers</strong>
                </a>
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors">
                  <span>YouTube</span>
                  <strong>12,345 Subscribers</strong>
                </a>
                <a href="#"
                  class="flex items-center justify-between p-3 rounded-lg text-white bg-teal-600 hover:bg-teal-700 transition-colors">
                  <span>Vimeo</span>
                  <strong>12,345 Followers</strong>
                </a>
              </div>
            </div>

            <!-- WIDGET: ADVERTISEMENT -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
              <h3 class="text-xl font-bold p-4 border-b">Advertisement</h3>
              <div class="p-4">
                <div class="bg-gray-200 rounded-lg overflow-hidden">
                  <img src="assets/img/bahlil.jpeg" alt="bahlil" class="w-full h-90 object-cover">
                </div>
              </div>
            </div>

            <!-- WIDGET: TRENDING NEWS -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
              <h3 class="text-xl font-bold p-4 border-b">Trending News</h3>
              <ul class="divide-y divide-gray-200">
                @forelse($trendingPosts as $post)
                  <li class="p-4 flex gap-4 items-center group">
                    <a href="{{ route('posts.show', $post) }}" class="block w-16 h-16 flex-shrink-0">
                      @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                          class="w-full h-full object-cover rounded-md group-hover:opacity-80 transition-opacity">
                      @else
                        <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                          <span class="text-gray-500 text-sm">No Img</span>
                        </div>
                      @endif
                    </a>
                    <div>
                      <span class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
                      <h4 class="text-base font-semibold leading-tight">
                        <a href="{{ route('posts.show', $post) }}"
                          class="text-gray-900 group-hover:text-yellow-600 transition-colors">
                          {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                        </a>
                      </h4>
                    </div>
                  </li>
                @empty
                  <li class="p-4 text-center text-gray-500">
                    Tidak ada berita trending.
                  </li>
                @endforelse
              </ul>
            </div>

            <!-- WIDGET: TAGS -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
              <h3 class="text-xl font-bold p-4 border-b">Tags</h3>
              <div class="p-4 flex flex-wrap gap-2">
                @forelse($tags as $tag)
                  <a href="{{ route('tags.show', $tag->name) }}"
                    class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-yellow-600 hover:text-white transition-colors">
                    {{ $tag->name }}
                  </a>
                @empty
                  <p class="text-gray-500 text-sm">Tidak ada tags untuk ditampilkan.</p>
                @endforelse
                <!-- [--- SELESAI PERUBAHAN ---] -->

              </div>
            </div>

          </div> <!-- Penutup 'sticky' wrapper -->
        </aside>
        <!-- PENUTUP KOLOM KANAN -->

      </div>
      <!-- PENUTUP GRID UTAMA -->


    @else
      <!-- Tampilan jika post kurang dari 5 -->
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded text-center" role="alert">
        <p class="font-bold">Belum Cukup Berita</p>
        <p>Belum ada cukup berita untuk ditampilkan dalam layout penuh. (Butuh minimal 5).</p>
        <p class="mt-2">Total berita saat ini: {{ $posts->count() }}</p>
      </div>
    @endif

  </div>

@endsection