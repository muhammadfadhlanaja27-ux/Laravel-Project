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
    Schema::create('categories', function (Blueprint $table) {
        $table->id(); 
        $table->string('name'); // Nama kategori, misal: 'Olahraga', 'Teknologi'
        $table->string('slug')->unique(); // Versi nama yang diubah jadi link, misal: 'olahraga'
        $table->timestamps(); // Kolom created_at dan updated_at
    });
}
};
