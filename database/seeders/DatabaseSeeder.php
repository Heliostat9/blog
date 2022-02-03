<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'heliostat',
            'password' => 'flashed213',
            'email' => 'xitrin02@mail.ru'
        ]);

        $user = User::factory()->create();
        $category = Category::factory()->create();
        Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $category->id
        ]);

        $user = User::factory()->create();

        Post::factory(10)->create([
            'user_id' => $user->id
        ]);

        Post::factory(30)->create();

        Comment::factory(10)->create();

    }
}
