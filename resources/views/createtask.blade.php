@extends('page')


@section('title','Create new task')

@section('pagetitle','Create a new task')


@section('content')
    <div>
        {{ var_dump($errors) }}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{url('/tasks')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label> <input type="text" class="form-control" name="name" id="name" value="" />
            </div>
            <div class="form-group">
                <label for="description">Description</label><textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <div class="input-group date" data-date-format="yyyy-mm-dd">
                    <div class="input-group-addon"><label for="duedate">Due Date</label></div>
                    <input type="text" class="form-control" name="duedate" id="duedate" value="" />
                    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                </div>
            </div>

            <a class="btn btn-default" href="{{ url('/tasks')}}" >Cancel</a>
            <input type="submit" class="btn btn-primary" value="Save" />
        </form>
    </div>

    <script>
        $('.date').datepicker({autoclose: true, clearBtn: true});
    </script>
@endsection
