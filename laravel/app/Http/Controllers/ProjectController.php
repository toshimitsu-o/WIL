<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Rules\WordCount;
use App\Models\Attribute;

class ProjectController extends Controller
{
    public function __construct() { $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create')->with('attributes', Attribute::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate Title and name must be more than 5 characters, email address must be an email address, description need to be at least 3 words, the number of students (team size) must be between 3 to 6. A project is added for a particular trimester in a particular year (called offering). The valid trimester is 1 to 3. If there is any validation error, the error(s) will be shown next to the form and the form will contain the previously entered values.
        $this->validate($request, [
            'name' => 'required|th:5',
            'email' => 'required|email:rfc',
            'description' => ['required', new WordCount],
            'capacity' => 'required|numeric|between:3,6',
            'offer_year' => 'required|numeric',
            'offer_trimester' => 'required|numeric|between:1,3',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->capacity = $request->capacity;
        $project->email = $request->email;
        $project->offer_year = $request->offer_year;
        $project->offer_trimester = $request->offer_trimester;
        $project->user_id = $request->user;
        $project->save();
        return redirect("project/$project->id");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return view('project.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('project.edit')->with('project', $project)->with('attributes', Attribute::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|min:6',
            'email' => 'required|email:rfc',
            'description' => ['required', new WordCount],
            'capacity' => 'required|numeric|between:3,6',
            'offer_year' => 'required|numeric',
            'offer_trimester' => 'required|numeric|between:1,3',
        ]);

        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->capacity = $request->capacity;
        $project->email = $request->email;
        $project->offer_year = $request->offer_year;
        $project->offer_trimester = $request->offer_trimester;
        $project->save();
        return redirect("project/$project->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect("project");
    }
}
