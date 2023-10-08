<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Rules\WordCount;
use App\Models\Attribute;
use App\Models\User;
use App\Models\Application;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $offer_years = Project::offer_years();
        $offer_trimesters = Project::offer_trimesters();
        return view('project.index', ['projects' => $projects, 'offer_years' => $offer_years, 'offer_trimesters' => $offer_trimesters]);
    }

    /**
     * Display projects belong to the ip user.
     * 
     * @param string $userId
     */
    public function by_ip(string $userId)
    {
        $ip = User::find($userId);
        if ($ip && $ip->usertype === 'ip') {
            $projects = Project::where('user_id', $userId)->get();
            return view('project.by_ip', ['projects' => $projects, 'ip' => $ip]);
        }
        return abort(404);
    }

    /**
     * Show the form for project application.
     * 
     * @param string $id Project ID
     */
    public function apply(string $id)
    {
        $project = Project::find($id);
        return view('project.apply', ['project' => $project]);
    }

    /**
     * Store a new application in storage.
     * 
     *  @param string $id Project ID
     */
    public function store_application(Request $request, string $id)
    {
        $user = $request->user();

        //dd(count($user->applications));

        if ($user->usertype !== 'student') {
            return back()->withErrors(array('You do not have a permission for this action.'))->withInput();
        }

        if (count(Application::where('user_id', $user->id)->where('project_id', $id)->get()) > 0) {
            return back()->withErrors(array('You have already applied to this project.'))->withInput();
        }

        if (is_null($user->gpa)) {
            return back()->withErrors(array('Please save your GPA in your profile.'))->withInput();
        }

        if (count($user->attributes) < 1) {
            return back()->withErrors(array('Please select preferences in your profile.'))->withInput();
        }

        if (count($user->applications) >= 3) {
            return back()->withErrors(array('You have already applied for 3 projects.'))->withInput();
        }

        $this->validate($request, [
            'justification' => 'required|min:1',
        ]);

        $application = new Application();
        $application->justification = $request->justification;
        $application->user_id = $user->id;
        $application->project_id = $id;
        $application->save();
        return redirect("project/$id");
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
        //dd($request);
        if ($request->user()->usertype !== 'ip' || is_null($request->user()->approved_at)) {
            return back()->withErrors(array('You do not have a permission for this action.'))->withInput();
        }

        // Validate Title and name must be more than 5 characters, email address must be an email address, description need to be at least 3 words, the number of students (team size) must be between 3 to 6. A project is added for a particular trimester in a particular year (called offering). The valid trimester is 1 to 3. If there is any validation error, the error(s) will be shown next to the form and the form will contain the previously entered values.
        $this->validate($request, [
            'name' => 'required|min:6',
            'email' => 'required|email:rfc,dns',
            'description' => ['required', new WordCount],
            'capacity' => 'required|numeric|between:3,6',
            'offer_year' => 'required|numeric|min:4',
            'offer_trimester' => 'required|numeric|between:1,3',
        ]);

        $duplicates = Project::where('offer_year', $request->offer_year)->where('offer_trimester', $request->offer_trimester)->where('name', $request->name)->get();

        if (count($duplicates) > 0) {
            return back()->withErrors(array('Cannot use the name. The name is already used in the same offering.'))->withInput();
        }



        // Create and save project
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->capacity = $request->capacity;
        $project->email = $request->email;
        $project->offer_year = $request->offer_year;
        $project->offer_trimester = $request->offer_trimester;
        $project->user_id = $request->user()->id;
        $project->save();
        // Attach attributes to add
        $project->attributes()->attach($request->input('attributes'));
        // Save files
        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                    // Store file and get filepath with a file name generated uniquely
                    $filepath = $file->store('project_files', 'public');
                    $project->projectfiles()->create(['filepath' => $filepath, 'filetype' => 'img']);
            }
        }
        if ($request->file('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                    // Store file and get filepath with a file name generated uniquely
                    $filepath = $file->store('project_files', 'public');
                    $project->projectfiles()->create(['filepath' => $filepath, 'filetype' => 'pdf']);
            }
        }
        

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

        if ($request->user()->id !== $project->user_id) {
            return back()->withErrors(array('You do not have a permission for this action.'))->withInput();
        }

        $project->name = $request->name;
        $project->description = $request->description;
        $project->capacity = $request->capacity;
        $project->email = $request->email;
        $project->offer_year = $request->offer_year;
        $project->offer_trimester = $request->offer_trimester;
        $project->save();

        // Sync attributes to update
        $project->attributes()->sync($request->input('attributes'));
        // Save files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                    // Store file and get filepath with a file name generated uniquely
                    $filepath = $file->store('project_files', 'public');
                    $project->projectfiles()->create(['filepath' => $filepath, 'filetype' => 'img']);
            }
        }
        if ($request->file('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                    // Store file and get filepath with a file name generated uniquely
                    $filepath = $file->store('project_files', 'public');
                    $project->projectfiles()->create(['filepath' => $filepath, 'filetype' => 'pdf']);
            }
        }
        return redirect("project/$project->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);

        if (auth()->id() !== $project->user_id) {
            return back()->withErrors(array('You do not have a permission for this action.'))->withInput();
        }

        if (count($project->applications) > 0) {
            return back()->withErrors(array('Cannot delete the project. The project has applicants already.'));
        }
        $project->delete();
        return redirect("project");
    }
}
