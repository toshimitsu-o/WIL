<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Project;
use \App\Models\Allocation;

class UserController extends Controller
{
    /**
     * Display users with usertype student.
     */
    public function students()
    {
        if (Auth::user()->usertype !== 'teacher') {
            return redirect('dashboard');
        }
        $users = User::where('usertype', 'student')->paginate(10);
        return view('user.index', ['users' => $users, 'usertype' => 'student']);
    }

    /**
     * Display student profile.
     * 
     * @param string $id userid
     */
    public function student(string $id)
    {
        if (Auth::user()->usertype === 'teacher' || Auth::user()->id == $id) {
            $user = User::find($id);
            return view('user.show', ['user' => $user, 'usertype' => 'student']);
        }
        return redirect('dashboard');
    }

    /**
     * Display IPs.
     */
    public function ips()
    {
        $users = User::where('usertype', 'ip')->get();
        return view('user.ips', ['users' => $users]);
    }

    /**
     * Store a new application in storage.
     * 
     * @param string $id User ID of ip
     */
    public function approve_ip(Request $request, string $id)
    {
        $user = $request->user();

        if ($user->usertype !== 'teacher') {
            return back()->withErrors(array('You do not have a permission for this action.'));
        }

        $ip = User::find($id);
        $ip->approved_at = now();
        $ip->save();
        return back();

    }

     /**
     * Store a new application in storage.
     */
    public function auto_allocate(Request $request)
    {
        if ($request->user()->usertype !== 'teacher') {
            return back()->withErrors(array('You do not have a permission for this action.'));
        }

        $users = User::where('usertype', 'student')->orderBy('gpa', 'desc')->get();
        $unassigned_users = array();
        //$assigned = array();

        foreach ($users as $user) {
            
            $project_ids = $user->applications->pluck('project_id')->toArray();
            //dd($project_ids);
            $matched = $this->match_project($user, $project_ids);
            
            if ($matched) {
                $allocation = new Allocation();
                $allocation->user_id = $user->id;
                $allocation->project_id = $matched;
                $allocation->save();
            
            } else {
                $unassigned_users[] = $user;
            }
        }

        //dd($assigned);
        //dd($unassigned_users);

        // Assign all unassigned users
        if (count($unassigned_users) > 0) {
            foreach($unassigned_users as $user) {
                $projects = Project::all();
                foreach($projects as $project) {
                    if($project->capacity > count($project->allocations)) {
                        $allocation = new Allocation();
                        $allocation->user_id = $user->id;
                        $allocation->project_id = $project->id;
                        $allocation->save();
                        break;
                    }
                }
            }
        }
        return back()->with('success_message', 'Auto Assign Completed');
    }

    /**
     * find a project for the user
     */
    private function match_project($user, $project_ids) {
        $project_scores = collect();
        foreach ($project_ids as $project_id) {
            
            $score = 0;
            $project = Project::find($project_id);

            // Role: user's attributes matches one of project's attributes
            $user_roles = $user->attributes->where('attributetype', 'role')->pluck('id')->toArray();
            $project_roles = $project->attributes->where('attributetype', 'role')->pluck('id')->toArray();
            if (count(array_intersect($user_roles, $project_roles)) > 0) {
                $score += 6;
                
            }

            // Skill
            $user_skills = $user->attributes->where('attributetype', 'skill')->pluck('id')->toArray();
            $project_skills = $project->attributes->where('attributetype', 'skill')->pluck('id')->toArray();
            if (count(array_intersect($user_skills, $project_skills)) > 0) {
                $score += 4;
                
            }

            // Industry
            $user_inds = $user->attributes->where('attributetype', 'industry')->pluck('id')->toArray();
            $project_inds = $project->attributes->where('attributetype', 'industry')->pluck('id')->toArray();
            if (count(array_intersect($user_inds, $project_inds)) > 0) {
                $score += 2;
            }

            // Add to scores
            $project_scores[] = ['id' => $project->id, 'score' => $score];
        }
        //dd($project_scores);
        foreach ($project_scores->sortByDesc('score')->pluck('id')->toArray() as $project_id) {
            
            $project = Project::find($project_id);
            if($project->capacity > count($project->allocations)) {
                return $project->id;
            }
        }
        return null;
    }
}
