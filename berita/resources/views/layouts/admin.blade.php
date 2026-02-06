<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Berita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { display: flex; }
        .sidebar { width: 250px; height: 100vh; background: #343a40; color: white; position: fixed; padding-top: 20px; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: #495057; }
        .content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h5 class="px-3">BizNews Dashboard</h5>
        <hr style="background-color: #495057;">
        <a href="{{ route('admin.categories.index') }}">Categories</a>
        <a href="{{ route('admin.tags.index') }}">Tags</a>
        <a href="{{ route('admin.posts.index') }}">Posts</a>
    </div>

    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>