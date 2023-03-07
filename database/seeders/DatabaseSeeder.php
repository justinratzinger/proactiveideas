<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       // ->has(Post::factory()->count(3))

       \App\Models\Category::factory(5)->create();

        $primaryUser = User::factory()->hasPosts(3, new Sequence(
            ['category_id' => '1'],
            ['category_id' => '2'],
        ))
        ->create([
            'name' => 'Justin Kekeocha',
            'email' => 'guest168544@gmail.com',
            'password' => Hash::make('hello123'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Secondary account',
            'email' => 'secondary@gmail.com',
            'password' => Hash::make('hello123')
        ]);
       
    }
}
