<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            ContactSeeder::class,
            DealStatusSeeder::class,
            //            DealTagSeeder::class, ???
            DealSeeder::class,
            NoteSeeder::class,
            TaskTypeSeeder::class,
            TaskSeeder::class,
            TestUserSeeder::class,
            FeedSeeder::class,
        ]);
    }
}
