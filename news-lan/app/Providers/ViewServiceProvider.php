<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Data untuk HEADER - Kirim ke component header
        View::composer('components.header', function ($view) {
            $popularTags = Tag::withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(8)
                ->get();
            
            $view->with('popularTags', $popularTags);
        });

        // Data untuk FOOTER - Kirim ke component footer
        View::composer('components.footer', function ($view) {
            // Popular Posts untuk footer (3 post terbaru)
            $popularFooterPosts = Post::with('category')
                ->latest()
                ->limit(3)
                ->get();

            // Tags untuk footer (8 tag terpopuler)
            $footerTags = Tag::withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(8)
                ->get();

            $view->with([
                'popularFooterPosts' => $popularFooterPosts,
                'footerTags' => $footerTags
            ]);
        });
    }
}