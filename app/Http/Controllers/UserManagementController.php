<?php

namespace Todolist\Http\Controllers;

use Illuminate\Http\Request;

use Todolist\Http\Requests;
use Todolist\Role;
use Todolist\User;

class UserManagementController extends Controller
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


    public function index()
    {
        $users = User::paginate(15);

        return view('userlist',['users'=>$users]);
    }


    /**
     * show form for new user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('createuser',['roles'=>Role::all()]);
    }


    public function store(Request $request)
    {

        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'same:passwordrepeat',
            'role_id' => 'required'
        ));
        // validate// TODO
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect('/users');
    }


    /**
     * show form for edit user
     *
     * @param $userid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($userid)
    {
        $user = User::findOrFail($userid);
        return view('edituser',['user' => $user, 'roles'=>Role::all()]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:passwordrepeat',
            'role_id' => 'required'
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect('/users');
    }


    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {
        User::destroy($userid);
    }



}
