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
        $n = 1000;
        $bar = $this->command->getOutput()->createProgressBar($n);
        $bar->start();
        for ($i = 0; $i < $n; $i++) {
            $specificUsers = $users->random(20);
            Post::factory()
                ->has(PostResponse::factory()
                    ->count(5)
                    ->state(new Sequence(
                        fn($sequence) => ['user_id' => $specificUsers->random()->id],
                    )), 'responses')
                ->create(['user_id' => $specificUsers->random()->id]);
            $bar->advance();
        }
        $bar->finish();

        $this->command->warn('Posts created');
    }
}
