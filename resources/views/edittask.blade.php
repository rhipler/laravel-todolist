@extends('layouts.page')

@section('title','Edit task')


@section('content')
    <div class="page-header">
        <h2>Edit Task</h2>
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
        <form action="{{url('/tasks/'.$task->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$task->id}}" />

            <input type ="hidden" name="_method" value="PUT" />

            <div class="form-group">
                <label for="name">Name</label> <input type="text" class="form-control" name="name" id="name" value="{{$task->name}}" />
            </div>
            <div class="form-group">
                <label for="description">Description</label><textarea class="form-control" name="description" id="description" rows="4">{{$task->description}}</textarea>
            </div>
            <div class="form-group">
            <div class="input-group date" data-date-format="yyyy-mm-dd">
                <div class="input-group-addon"><label for="duedate">Due Date</label></div>
                <input type="text" class="form-control" name="duedate" id="duedate" value="{{ $task->duedate ? date('Y-m-d',strtotime($task->duedate)) : '' }}" />
                <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
            </div>
            </div>

            <div class="form-group">
                Created at {{ date('d.m.Y H:i:s P',strtotime($task->created_at)) }}
            </div>
            <a class="btn btn-default" href="{{ url('/tasks')}}" >Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save" />
        </form>


    </div>

    <script>
        $('.date').datepicker({autoclose: true, clearBtn: true,
            language: 'de'
        });
    </script>
@endsection
