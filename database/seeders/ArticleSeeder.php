<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        Article::create([
            'title' => "Article Name 1",
            'slug' => "article-name-1",
            'content' => "Article Description 1",
            'header_articles' => 'thumbnail/9mIvq2JWLpD7XB25IvizmMWFTCuhg7XMphPO40am.jpg', 
            'status' => 'PUBLISH',
            'category_id' => $categories[0]->id,
        ]);

        Article::create([
            'title' => "Article Name 2",
            'slug' => "article-name-1",
            'content' => "Article Description 2",
            'header_articles' => 'thumbnail/K9EjoqhqSm7sewMMCKjU631a7KFro7UReqE7tpWZ.jpg', 
            'status' => 'PUBLISH',
            'category_id' => $categories[0]->id,
        ]);

        Article::create([
            'title' => "Article Name 3",
            'slug' => "article-name-3",
            'content' => "Article Description 3",
            'header_articles' => 'thumbnail/zk8QXwF28t71iDSb5KkjPd156FSr9KqPuPs0a1KM.jpg', 
            'status' => 'PUBLISH',
            'category_id' => $categories[1]->id,
        ]);

        Article::create([
            'title' => "Article Name 4",
            'slug' => "article-name-4",
            'content' => "Article Description 4",
            'header_articles' => 'thumbnail/2eGiFGnJ7i8QjuYgmfj6RG2jVoc81UdZaMCbxNAP.jpg', 
            'status' => 'DRAFT',
            'category_id' => $categories[1]->id,
        ]);

    }
}