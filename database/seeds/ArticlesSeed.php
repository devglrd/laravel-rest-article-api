<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 30)->create();
    }
}
