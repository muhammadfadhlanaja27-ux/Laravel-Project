<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)->only(['index', 'show']);

// Route untuk search
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

// Routes untuk Comments
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

Route::resource('categories', CategoryController::class)->only(['index', 'show']);

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tag/{tag:name}', [TagController::class, 'show'])->name('tags.show');

/*
|--------------------------------------------------------------------------
| Rute Dashboard & Admin
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $posts = Post::latest()->paginate(10);
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Posts Management
        Route::resource('posts', AdminPostController::class)->except(['show']);
        
        // Categories Management
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        
        // Tags Management
        Route::resource('tags', AdminTagController::class)->except(['show']);
    });

require __DIR__.'/auth.php';