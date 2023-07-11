<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\ExpendedTime;
use App\Models\Project;
use App\Models\Task;
use Illuminate\View\View;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): View
    {
        $tasks = Task::orderBy('id','ASC')->paginate(15);

        return view('tasklist', ['tasks' => $tasks,'projectid'=>0, 'heading'=>'All Tasks']);
    }


    /**
     * list task of Project $projectid
     * @param $projectid
     */
    public function listTasks($projectid): View
    {
        $project = Project::findOrFail($projectid);
        $tasks = $project->tasks()->orderBy('id','ASC')->paginate(15);

        return view('tasklist', ['tasks' => $tasks,'projectid'=>$projectid, 'heading'=>'Tasks of Project '.$project->name] );
    }



    /**
     * Show the form for creating a new resource.
     *
     */
    public function create($projectid): View
    {
        return view('createtask',['projectid'=>$projectid]);
    }


    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, array('name' => 'required|max:255', 'duedate' =>'nullable|date_format:Y-m-d','projectid'=>'exists:projects,id'));

        $task = new Task();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->duedate =  ($request->input('duedate')) ? date('Y-m-d H:i:s', strtotime($request->input('duedate'))) : null;
        $task->projectid = $request->input('projectid');
        $task->createdByUser()->associate( Auth::user());
        $task->save();

        return redirect('/project/'.$request->input('projectid').'/tasks');
    }


    /**
     * Display the specified resource.
     *
     */
    public function show(int $id): View
    {
        $task = Task::with(['comments' => function ($query) {
                $query->orderBy('created_at');
            }])
            ->with(['expendedtimes' => function ($query) {
                $query->orderBy('date', 'ASC');
            }])
            ->findOrFail($id);

        return view('showtask',['task'=>$task]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(int $id): View
    {
        $task = Task::findOrFail($id);

        return view('edittask', ['task' => $task]);
    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $this->validate($request, array('name' => 'required|max:255', 'duedate' => 'nullable|date_format:Y-m-d'));

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
     */
    public function destroy(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $pid =  $task->projectid;
        $task->delete();

        return to_route('tasks.list',$pid);
    }


    public function addTime(int $taskid, Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'expdescription' => 'required|max:60',
            'exptime' => 'required|numeric',
            'expdate' => 'required|date_format:Y-m-d']);

        $task = Task::findOrFail($taskid);

        $expTime = new ExpendedTime();
        $expTime->description = $validated['expdescription'];
        $expTime->time = $validated['exptime'];
        $expTime->date = $validated['expdate'];
        $expTime->user()->associate(Auth::user());

        $task->expendedTimes()->save($expTime);

        return redirect('/tasks/'.$taskid);
    }

    public function deleteTime(int $timeid): RedirectResponse
    {
        $time = ExpendedTime::find($timeid);
        $taskid = $time->task_id;
        $time->delete();
        return to_route('task.show',$taskid);
    }


    public function addComment(int $taskid, Request $request): RedirectResponse
    {
        $this->validate($request, ['comment' => 'required']);
        $task = Task::findOrFail($taskid);

        $comment = new Comment();
        $comment->user()->associate(Auth::user());
        $comment->comment = $request->input('comment');
        $comment->task_id = $taskid;
        $comment->save();

        return redirect('/tasks/'.$taskid);
    }

    public function deleteComment(int $commentid)
    {
        Comment::destroy($commentid);
    }

}
