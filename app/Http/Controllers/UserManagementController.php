<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class UserManagementController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);

        return view('userlist',['users'=>$users]);
    }


    /**
     * show form for new user
     *
     */
    public function create(): View
    {
        return view('createuser',['roles'=>Role::all()]);
    }


    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'same:passwordrepeat',
            'role_id' => 'required'
        ));

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
     */
    public function edit($userid): View
    {
        $user = User::findOrFail($userid);
        return view('edituser',['user' => $user, 'roles'=>Role::all()]);
    }

    /**
     * Update the specified user in storage.
     *
     */
    public function update($id, Request $request): RedirectResponse
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

        return to_route('users.index');
    }


    /**
     * Remove the specified user from storage.
     *
     */
    public function destroy($userid)
    {
        User::destroy($userid);

        return to_route('users.index');
    }


}
