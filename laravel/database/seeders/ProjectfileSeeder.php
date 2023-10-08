<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Project;
use App\Models\Projectfile;

class ProjectfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $images = collect([
            "project_files/project1.jpg",
            "project_files/project2.jpg",
            "project_files/project3.jpg",
        ]);

        foreach ($projects as $project) {
            $image = new Projectfile();
            $image->project_id = $project->id;
            $image->filetype = 'img';
            $image->filepath = $images->random();
            $image->save();
        }
    }
}
