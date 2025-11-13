<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    // Relasi: satu tag bisa dimiliki banyak post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}