.<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post; // Pastikan Post Model di-import
use App\Models\Tag;  // Pastikan Tag Model di-import

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi tabel pivot 'post_tag' dengan data dummy.
     */
    public function run(): void
    {
        // Ambil semua Post dan semua Tag yang ada
        $posts = Post::all();
        $tags = Tag::all();

        // Pastikan ada data Posts dan Tags sebelum mencoba menghubungkan
        if ($posts->isEmpty() || $tags->isEmpty()) {
            echo "Posts atau Tags kosong. Lewati PostTagSeeder.\n";
            return;
        }

        // Loop melalui setiap Post
        foreach ($posts as $post) {
            // Pilih 2 hingga 4 Tags secara acak dari semua Tags yang tersedia
            $randomTags = $tags->random(rand(2, min(4, $tags->count())));
            
            // Hubungkan Post ini dengan Tags yang dipilih
            $tagIds = $randomTags->pluck('id')->toArray();
            
            // Masukkan data ke tabel pivot 'post_tag'
            $dataToInsert = [];
            foreach ($tagIds as $tagId) {
                $dataToInsert[] = [
                    'post_id' => $post->id,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Masukkan secara batch untuk efisiensi
            DB::table('post_tag')->insert($dataToInsert);
        }

        echo "Berhasil mengisi tabel 'post_tag' dengan " . count($dataToInsert) . " relasi.\n";
    }
}