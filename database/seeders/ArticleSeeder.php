<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Hash;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = json_decode(file_get_contents(public_path() . '/articles.json'));
        foreach ($articles as $article) {
            Article::create([
                'date' => $article->date,
                'name' => $article->name,
                'desc' => $article->desc,
                'user_id' => random_int(1, 10),
            ]);
        }
    }
}