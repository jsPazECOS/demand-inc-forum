<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use App\Models\Post\PostResponse;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;


class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->warn('Running PostsSeeder');
        $users = User::all(['id']);
        $bar = $this->command->getOutput()->createProgressBar(100);
        $bar->start();
        for ($i = 0; $i < 100; $i++) {
            Post::factory()
                ->count(100)
                ->state(new Sequence(
                    fn($sequence) => ['user_id' => $users->random()->id],
                ))->create()->each(function ($post) use ($users) {
                    PostResponse::factory()->count(5)
                        ->state(new Sequence(
                            fn($sequence) => ['user_id' => $users->random()->id],
                        ))->create([
                            'post_id' => $post->id
                        ]);
                });
            $bar->advance();
        }
        $bar->finish();

        $this->command->warn('Posts created');
    }
}
