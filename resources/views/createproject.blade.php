@extends('layouts.page')

@section('title','Create new Project')


@section('content')
    <div class="page-header">
        <h2>Create New Project</h2>
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
        <form action="{{url('/project')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label> <input type="text" class="form-control" name="name" id="name" value="" />
            </div>
            <div class="form-group">
                <label for="description">Description</label><textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>

            <a class="btn btn-default" href="{{ url('/project')}}" >Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save" />
        </form>
    </div>

@endsection
