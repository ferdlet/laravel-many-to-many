<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->words(7, true);
            $newPost->slug = Str::of($newPost->title)->slug("-");
            $newPost->content = $faker->paragraph(5);
            $newPost->published = rand(0,1);
            $newPost->save();
        }
    }
}
