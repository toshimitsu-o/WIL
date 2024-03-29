<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AttributeSeeder::class);

        // Create student users
        \App\Models\User::factory()->count(50)->student()->create();
        // Create 1 teacher, 7 ip users
        $this->call(UserSeeder::class);

        \App\Models\Project::factory()->count(15)->create();
        $this->call(ProjectfileSeeder::class);

        // Attach attributes for students and projects
        $this->call(UserAttributeSeeder::class);
        $this->call(ProjectAttributeSeeder::class);
        
        // Seed applications for students and projects
        $this->call(ApplicationSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
