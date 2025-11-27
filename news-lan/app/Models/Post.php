<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'thumbnail',
        'category_id'
    ];

    /**
     * Relasi ke Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Tags (Many-to-Many)
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    /**
     * Relasi ke User (Author)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Comments (TAMBAHAN BARU)
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get only approved comments (untuk tampilan publik)
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->where('is_approved', true)
            ->latest();
    }

    /**
     * Get comments count (hanya yang approved)
     */
    public function getApprovedCommentsCountAttribute(): int
    {
        return $this->comments()->where('is_approved', true)->count();
    }
}