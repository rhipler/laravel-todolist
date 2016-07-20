<?php

namespace Todolist\Http\Controllers;

use Illuminate\Http\Request;
use Todolist\Http\Requests;
use Todolist\Task;


class TaskController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id','ASC')->paginate(10);

        return view('tasklist', ['tasks' => $tasks,'projectid'=>0, 'heading'=>'All Tasks']);
    }


    /**
     * list task of Project $projectid
     * @param $projectid
     */
    public function listTasks($projectid)
    {

        $tasks = Task::where('projectid',$projectid)->orderBy('id','ASC')->paginate(10);

        return view('tasklist', ['tasks' => $tasks,'projectid'=>$projectid, 'heading'=>'Tasks of Project '.$projectid]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectid)
    {
        return view('createtask',['projectid'=>$projectid]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array('name' => 'required|max:255', 'duedate' =>'date_format:Y-m-d','projectid'=>'exists:projects,id'));


        $task = new Task();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->duedate =  ($request->input('duedate')) ? date('Y-m-d H:i:s', strtotime($request->input('duedate'))) : null;
        $task->projectid = $request->input('projectid');

        $task->save();

        return redirect('/project/'.$request->input('projectid').'/tasks');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return view('showtask');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $task = Task::findOrFail($id);

        return view('edittask', ['task' => $task]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $this->validate($request, array('name' => 'required|max:255', 'duedate' => 'date_format:Y-m-d'));

        $duedate = ($request->input('duedate')) ? date('Y-m-d H:i:s', strtotime($request->input('duedate'))) : null;

        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->duedate = $duedate;
        $task->save();

        return redirect('/project/' .$task->projectid .'/tasks');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
    }

}
