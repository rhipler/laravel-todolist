@extends('layouts.page')

@section('title','Edit Project')


@section('content')
    <div class="page-header">
        <h2>Edit Project</h2>
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
        <form action="{{url('/project/'.$project->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$project->id}}" />

            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group">
                <label for="name">Name</label> <input type="text" class="form-control" name="name" id="name"
                                                      value="{{$project->name}}"/>
            </div>
            <div class="form-group">
                <label for="description">Description</label><textarea class="form-control" name="description"
                                                                      id="description"
                                                                      rows="4">{{$project->description}}</textarea>
            </div>

            <div class="form-group">
                <label>Created at </label> {{ $project->created_at }}
            </div>

            <div class="form-group">
                <label>Last updated at </label> {{ $project->updated_at }}
            </div>

            <a class="btn btn-default" href="{{ url('/project')}}">Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save"/>
        </form>
    </div>

@endsection
