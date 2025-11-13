@extends('layouts.app')
@section('content')

  <div class="container">
    <h1>{{ $post->title }}</h1>
    <p><strong>Penulis:</strong> {{ $post->author }}</p>
    <p>{{ $post->content }}</p>
    @if($post->thumbnail)
      <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid mb-3" alt="Thumbnail">
    @endif
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
@endsection