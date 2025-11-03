<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Resume
|--------------------------------------------------------------------------
*/

// Redirect root to about page
Route::get('/', function () {
    return redirect()->route('about');
});

// Resume Routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/experience', function () {
    return view('experience');
})->name('experience');

Route::get('/education', function () {
    return view('education');
})->name('education');

Route::get('/skills', function () {
    return view('skills');
})->name('skills');

Route::get('/interests', function () {
    return view('interests');
})->name('interests');

Route::get('/awards', function () {
    return view('awards');
})->name('awards');