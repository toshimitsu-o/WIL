<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Project;
use \App\Models\Attribute;

class ProjectAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            // Get random attribute of each type
            $role = Attribute::where('attributetype', 'role')->get()->random(2)->pluck('id')->toArray();
            $skill = Attribute::where('attributetype', 'skill')->get()->random()->id;
            $industry = Attribute::where('attributetype', 'industry')->get()->random()->id;

            $project->attributes()->attach(array_merge($role, [$skill], [$industry]));
        }
    }
}
