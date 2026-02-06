<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ...
class Tag extends Model
{
    public function posts() {
        return $this->hasMany(Post::class); // Kategori BISA punya BANYAK Postingan
    }
}