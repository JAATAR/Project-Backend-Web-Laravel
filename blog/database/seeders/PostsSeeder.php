<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('posts')->insert([
            'title' => 'First post',
            'description' => 'Description van het eerste post.',
            'image' => 'image1.jpg',
            'name' => 'Author post',
            'user_id' => 1,
            'post_status' => 'published',
            'usertype' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'Deuxième post',
            'description' => 'hier is de descirption van het tweede post .',
            'image' => 'image2.jpg',
            'name' => 'Auteur van tweede post',
            'user_id' => 2,
            'post_status' => 'draft',
            'usertype' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
