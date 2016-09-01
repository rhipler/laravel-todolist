@extends('layouts.page')

@section('title','Task')


@section('content')
    <div class="page-header">
        <h2>Task</h2>
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


        <div>
            <div class="form-group">
                <label for="name">Name</label> {{$task->name}}
            </div>
            <div class="form-group">
                <div class="input-group" >
                    <div class="input-group-addon"><label for="description">Description</label></div>
                    <p class="form-control-static" style="border: 1px solid #ccc; border-radius: 4px; border-top-left-radius: 0; border-bottom-left-radius: 0"> {{$task->description}}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group" >
                    <div class="input-group-addon"><label for="duedate">Due Date</label></div>
                    <p class="form-control"> {{ $task->duedate ? date('Y-m-d',strtotime($task->duedate)) : '' }} </p>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group" >
                    <div class="input-group-addon"><label>Created at</label></div>
                    <p class="form-control" > {{ date('d.m.Y H:i:s P',strtotime($task->created_at)) }} </p>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><label>Created By</label></div>
                <p class="form-control">{{ $task->createdByUser->name}}</p>
                    </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><label>Last Updated at</label></div>
                <p class="form-control">{{ date('d.m.Y H:i:s P',strtotime($task->updated_at)) }}</p>
                    </div>
            </div>

            <a class="btn btn-default" href="{{ url('/project/' .$task->projectid .'/tasks')}}" >Back</a>
            <a class="btn btn-default" href="{{ url('/tasks/' .$task->id .'/edit')}}" >Edit</a>

            </div>

            <div class="row">

                <div class="col-md-8">
                <h3>Comments</h3>

                <div>
                    @foreach($task->comments as $comment)
                        <div class="row">
                            <div class="col-sm-4">{{$comment->created_at}} {{$comment->user_id}} </div>
                            <div class="col-sm-8">{{$comment->comment}}</div>
                        </div>
                    @endforeach



                    <div class="form-group">
                        <label>Neuer Kommentar</label>
                        <textarea></textarea>

                        <button>senden</button>
                    </div>
                </div>

                    </div>

                <div class="col-md-4">

                    <h3>Expended Time</h3>

                    <table style="width:100%" class="table table-hover">
                        @foreach($task->expendedtimes as $exptime)

                            <tr>
                                <td style="min-width: 90px">{{$exptime->date}} {{$exptime->user->name}} </td>
                                <td style="word-break: break-all">{{$exptime->description}}</td>
                                <td style="min-width:60px;">{{$exptime->time}} h</td>
                            </tr>
                        @endforeach

                    </table>

                    <form class="form-horizontal" method="post" action="{{url('/tasks/'.$task->id.'/addtime')}}" >
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="col-sm-6">

                            <label class="control-label" for="expdate">Date</label>
                            <div class="input-group date" data-date-format="yyyy-mm-dd">
                                <input type="text" class="form-control" name="expdate" id="expdate" size="8" value="" />
                                <span class="input-group-btn"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-th"></span></button></span>
                            </div>

                            </div>

                            <div class="col-sm-6 {{ count($errors->get('exptime'))>0 ? 'has-error' : ''  }} ">

                                <label class="control-label">Expended Time (h)</label>
                                <input class="form-control" type="text" name="exptime" id="exptime" maxlength="5" size="5" />
                                @foreach($errors->get('exptime') as $error )
                                    {{$error}}
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 {{ count($errors->get('expdescription'))>0 ? 'has-error' : ''  }}">
                                <label class="control-label">Description</label>
                                <input class="form-control" type="text" name="expdescription" id="expdescription" placeholder="description" size="40"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                            <input style="float:right" type="submit" class="btn btn-primary" value="add">
                            </div>
                        </div>

                    </form>

                </div>

            </div>


    </div>
    <script>
        $('.date').datepicker({autoclose: true, clearBtn: true,
            language: 'en'
        });
    </script>

@endsection
