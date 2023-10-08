<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Project;
use \App\Models\Application;
use Illuminate\Support\Facades\Log;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('usertype', 'student')->get();
        $justifications = collect([
            "I have all skills needed for the role in the project even though I am applying through the seeder function.",
            "The project has all elements of skills and knowledge that I learned and would like to practice.",
            "I am capable of tasks and responsibles that the project requires. I am confident to contribute to the organisation."
        ]);

        foreach ($users as $user) {

            // shuffle() to randomise the order of projects
            $projects = Project::all()->shuffle();
            $applied = 0;

            $user_attributes = $user->attributes->pluck('id')->toArray();

            foreach ($projects as $project) {
                if ($applied >= 3) {
                    break;
                }
                $project_attributes = $project->attributes->pluck('id')->toArray();
                
                $matched = array_intersect($user_attributes, $project_attributes);

                Log::info('Matched:' . count($matched). 'user:'  . count($user_attributes) . 'project:' . count($project_attributes));

                if (count($matched) >= 1) {
                    $application = new Application();
                    $application->user_id = $user->id;
                    $application->project_id = $project->id;
                    $application->justification = $justifications->random();
                    $application->save();

                    $applied += 1;
                }
            }
        }
    }
}
