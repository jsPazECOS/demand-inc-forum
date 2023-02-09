<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->warn('Running UsersSeeder');
        User::factory()->create(['email' => 'test@laravel.com']);
        User::factory(1000)->create();
        $this->command->warn('Users created');
    }
}
