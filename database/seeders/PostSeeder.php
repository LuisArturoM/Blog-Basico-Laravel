<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
        ['author_id' => '1', 'tittle' => 'Post 1','content' => 'Este es el post 1'],
        ['author_id' => '2', 'tittle' => 'Post 2','content' => 'Este es el post 2'],
        ['author_id' => '3', 'tittle' => 'Post 3','content' => 'Este es el post 3'],
        ['author_id' => '4', 'tittle' => 'Post 4','content' => 'Este es el post 4'],
        ['author_id' => '5', 'tittle' => 'Post 5','content' => 'Este es el post 5'],
        ['author_id' => '6', 'tittle' => 'Post 6','content' => 'Este es el post 6'],
        ['author_id' => '7', 'tittle' => 'Post 7','content' => 'Este es el post 7'],
        ['author_id' => '8', 'tittle' => 'Post 8','content' => 'Este es el post 8'],
        ['author_id' => '9', 'tittle' => 'Post 9','content' => 'Este es el post 9'],
        ['author_id' => '10', 'tittle' => 'Post 10','content' => 'Esta es el post 10'],
        ];

        DB::table('posts')->insert($posts);
    }
}
