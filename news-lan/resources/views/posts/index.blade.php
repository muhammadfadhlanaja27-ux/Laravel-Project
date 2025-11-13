@extends('layouts.app')
@section('content')

  <div class="container">
    <h1>Daftar Berita</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+ Tambah Berita</a>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tanggal</th>
        <th>Aksi</th>
        <th>Thumbnail</th>
      </tr>

      @foreach ($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ $post->author }}</td>
          <td>{{ $post->created_at->format('d M Y') }}</td>
          <td>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">Lihat</a>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
          </td>
          <td>
            @if($post->thumbnail)
              <img src="{{ asset('storage/' . $post->thumbnail) }}" width="80">
            @endif
          </td>
        </tr>
      @endforeach
    </table>
    {{ $posts->links() }}
  </div>
@endsection