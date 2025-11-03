<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [PageController::class, 'home'])->name('home');

// About
Route::get('/about', [PageController::class, 'about'])->name('about');

// Resume
Route::get('/resume', [PageController::class, 'resume'])->name('resume');

// Portfolio
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{id}', [PageController::class, 'portfolioDetail'])->name('portfolio.detail');

// Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');