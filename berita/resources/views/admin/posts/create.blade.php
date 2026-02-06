@extends('layouts.admin')

@section('content')
    <h3>Tambah Postingan Berita Baru</h3>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Judul Berita</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                {{-- $categories datang dari PostController@create --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="body">Isi Berita</label>
            <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="10">{{ old('body') }}</textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail">Thumbnail (Gambar)</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control-file @error('thumbnail') is-invalid @enderror">
            <small class="form-text text-muted">Max 2MB, format JPG/PNG/GIF.</small>
        </div>

        <div class="form-group">
            <label for="tags">Tags (Tahan Ctrl/Cmd untuk pilih banyak)</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                {{-- $tags datang dari PostController@create --}}
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Postingan</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection