@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Postingan Berita</h3>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Tambah Postingan</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tags</th>
                <th>Author</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>
                    {{-- Menampilkan gambar dari storage --}}
                    @if ($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" width="80" alt="{{ $post->title }}">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>{{ $post->user->name ?? 'User ID 1' }}</td>
                <td>
                    <a href="{{-- route('admin.posts.edit', $post) --}}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada postingan berita.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection