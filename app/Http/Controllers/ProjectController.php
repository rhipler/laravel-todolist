<?php

namespace Todolist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Todolist\Http\Requests;
use Todolist\Project;

class ProjectController extends Controller
{


    public function index()
    {
        $projects = Project::all();

        return view('projectlist', ['projects'=>$projects] );
    }


    /**
     * show form for creating new project
     */
    public function create()
    {
        return view('createproject');

    }


    /**
     * store new craeted project
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());

        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();

        return redirect('/project');
    }


    protected function getRules() {
        return ['name'=>'required'];
    }


    /**
     * show edit project form
     * @param $projectid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($projectid) {
        $project = Project::find($projectid);

        return view('editproject',['project'=>$project]);
    }


    public function update($projectid, Request $request)
    {
        $this->validate($request, $this->getRules());

        $project = Project::findOrFail($projectid);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();

        return redirect('/project');
    }


    public function destroy($projectid)
    {
        Project::destroy($projectid);
    }

}
