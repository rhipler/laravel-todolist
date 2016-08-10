@extends('layouts.page')

@section('title','Edit user')


@section('content')
    <div class="page-header">
        <h2>Edit user</h2>
    </div>

    <div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{url('/users/'.$user->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$user->id}}" />
            <input type ="hidden" name="_method" value="PUT" />

            <div class="form-group">
                <label for="name">Name</label> <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" />
            </div>
            <div class="form-group">
                <label for="email">Email</label> <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" />
            </div>

            <div class="form-group">
                <label for="password">Change Passsword</label> <input type="password" class="form-control" name="password" id="password" />
            </div>
            <div class="form-group">
                <label for="passwordrepeat">Password (repeat)</label> <input type="password" class="form-control" name="passwordrepeat" id="passwordrepeat" />
            </div>


            <div class="form-group">
                <label for="role_id">Role</label>
                <select id="role_id" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" @if ($role->id==$user->role_id) selected="selected" @endif> {{$role->name}} </option>
                    @endforeach

                </select>
            </div>


            <a class="btn btn-default" href="{{ url('/users')}}" >Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save" />
        </form>
    </div>

@endsection
