@extends('layouts.app')
@section('content')

  <div class="container">
    <h1>Edit Berita</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Isi Berita</label>
        <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
      </div>
      <div class="mb-3">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
      </div>
      <div class="mb-3">
        <label>Kategori</label>
        <select name="category_id" class="form-control">
          <option value="">-- Pilih Kategori --</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Tag</label><br>
        @foreach($tags as $tag)
          <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}</label><br>
        @endforeach
      </div>
      <button class="btn btn-primary">Update</button>
      <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
@endsection