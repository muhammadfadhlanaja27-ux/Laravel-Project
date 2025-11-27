<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $popularTags = Tag::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->limit(8)
                ->get();

            $view->with('popularTags', $popularTags);
        });
    }
}