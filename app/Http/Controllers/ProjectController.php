<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::orderBy('id','ASC')->get();

        return view('projectlist', ['projects'=>$projects] );
    }


    /**
     * show form for creating new project
     */
    public function create(): View
    {
        return view('createproject');
    }


    /**
     * store new created project
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, $this->getRules());

        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();

        return to_route('project.index');
    }


    protected function getRules() {
        return ['name'=>'required'];
    }


    /**
     * show edit project form
     */
    public function edit($projectid): View
    {
        $project = Project::findOrFail($projectid);

        return view('editproject',['project'=>$project]);
    }


    public function update($projectid, Request $request): RedirectResponse
    {
        $this->validate($request, $this->getRules());

        $project = Project::findOrFail($projectid);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();

        return to_route('project.index');
    }


    public function destroy($projectid)
    {
        Project::destroy($projectid);

        return to_route('project.index');
    }

}
