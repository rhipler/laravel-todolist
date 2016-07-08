<?php

namespace Todolist\Http\Controllers;

use Illuminate\Http\Request;
use Todolist\Http\Requests;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $tasks = DB::table('tasks')->orderBy('id', 'ASC')->paginate(10);

        return view('tasklist', ['tasks' => $tasks]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createtask');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //TODO validate
        $this->validate($request, array('name' => 'required|max:255', 'duedate' =>'date_format:Y-d-m'));

        $name = $request->input('name');
        $description = $request->input('description');
        $inputdate = $request->input('duedate');
        $duedate = ($inputdate) ? date('Y-m-d H:i:s', strtotime($inputdate)) : null;

        DB::table('tasks')->insert(['name' => $name, 'description' => $description, 'duedate' => $duedate, 'created_at' => date('Y-m-d H:i:s P')]);

        return redirect('/tasks');
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
        $task = DB::table('tasks')->where('id', $id)->first();

        if (!$task) {
            // Task not found
            return redirect('/tasks');
        }

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

        $this->validate($request, array('name' => 'required|max:255', 'duedate' => 'date_format:Y-d-m'));

        $duedate = ($request->input('duedate')) ? date('Y-m-d H:i:s', strtotime($request->input('duedate'))) : null;

        $affected = DB::table('tasks')->where('id', $id)
            ->update(['name' => $request->input('name'),
                'description' =>$request->input('description'),
                'duedate' => $duedate,
                'updated_at' => date('Y-m-d H:i:s P')] );

        return redirect('/tasks');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tasks')->where('id', '=', $id)->delete();
    }

}
