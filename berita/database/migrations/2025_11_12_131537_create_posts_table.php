<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('body');
        
        // FITUR THUMBNAIL (Tugas 2)
        // Menyimpan path/alamat gambar thumbnail. nullable artinya boleh kosong.
        $table->string('thumbnail')->nullable(); 
        
        // FOREIGN KEY (Kunci Tamu) ke tabel lain:
        
        // 1. Relasi ke Kategori (Tugas 4)
        $table->foreignId('category_id')
              ->constrained('categories') // Merujuk ke tabel 'categories'
              ->onDelete('cascade');     // Jika kategori dihapus, post ini ikut terhapus
              
        // 2. Relasi ke Author (Tugas 8)
        $table->foreignId('user_id')
              ->constrained('users')      // Merujuk ke tabel 'users' (bawaan Laravel)
              ->onDelete('cascade');
              
        $table->timestamps();
    });
}
};
