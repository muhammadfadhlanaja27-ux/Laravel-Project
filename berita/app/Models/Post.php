<?php
// ...
class Post extends Model
{
    // Tambahkan kolom yang bisa diisi
    protected $fillable = [
        'title', 'slug', 'body', 'thumbnail', 'category_id', 'user_id'
    ];
    
    // RELASI
    public function category() {
        return $this->belongsTo(Category::class); // Postingan HANYA milik 1 Kategori
    }
    public function tags() {
        return $this->belongsToMany(Tag::class); // Postingan BISA punya BANYAK Tags
    }
    public function user() {
        return $this->belongsTo(User::class); // Postingan HANYA milik 1 User (Author)
    }
}