<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Attribute;

class UserAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('usertype', 'student')->get();

        foreach ($users as $user) {
            // Get random attribute of each type
            $role = Attribute::where('attributetype', 'role')->get()->random()->id;
            $skill = Attribute::where('attributetype', 'skill')->get()->random()->id;
            $industry = Attribute::where('attributetype', 'industry')->get()->random()->id;

            $user->attributes()->attach([$role, $skill, $industry]);
        }
    }
}
