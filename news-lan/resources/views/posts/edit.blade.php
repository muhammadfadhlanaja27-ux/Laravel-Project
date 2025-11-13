@extends('layouts.app')
@section('content')
  <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
      <div class="card shadow-sm mb-4">
        {{-- Thumbnail --}}
        @if($post->thumbnail)
          <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="card-img-top"
            style="max-height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
          {{-- Judul --}}
          <h2 class="card-title">{{ $post->title }}</h2>
          {{-- Info tambahan --}}
          <div class="text-muted mb-3">
            <small>
              Oleh <strong>{{ $post->author ?? 'Admin' }}</strong> |
              {{ $post->created_at->format('d M Y') }}
            </small><br>
            {{-- Kategori --}}
            @if($post->category)
              <span class="badge bg-primary">Kategori: {{ $post->category->name }}</span>
            @endif
          </div>
          {{-- Isi berita --}}
          <div class="card-text" style="white-space: pre-line;">
            {!! nl2br(e($post->content)) !!}
          </div>
          {{-- Tag --}}
          @if($post->tags->count() > 0)
            <div class="mt-4">
              <strong>Tags:</strong><br>
              @foreach($post->tags as $tag)
                <span class="badge bg-secondary">{{ $tag->name }}</span>
              @endforeach
            </div>
          @endif
          {{-- Tombol aksi --}}
          <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Kembali</a>
          </div>
        </div>
      </div>
  </form>
@endsection