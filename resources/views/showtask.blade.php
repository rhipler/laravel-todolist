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
            <div class="row">
                <div class="col-sm-2"><label class="label label-default" >Name </label></div>
                <div class="col-sm-10"><p class="border-panel">{{$task->name}}</p></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label class="label label-default" for="description">Description</label></div>
                <div class="col-sm-10"><p class="border-panel"> {{$task->description}}</p></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label class="label label-default" >Due Date</label></div>
                <div class="col-sm-10"><p class="border-panel"> {{ $task->duedate ? date('Y-m-d',strtotime($task->duedate)) : '' }} </p></div>
            </div>

            <div class="row">
                <div class="col-sm-2"><label class="label label-default" >Created at</label></div>
                <div class="col-sm-10"><p class="border-panel" > {{ date('d.m.Y H:i:s P',strtotime($task->created_at)) }} </p></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label class="label label-default" >Created By</label></div>
                <div class="col-sm-10"><p class="border-panel">{{ $task->createdByUser->name}}</p></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><label class="label label-default" >Last Updated at</label></div>
                <div class="col-sm-10"><p class="border-panel">{{ date('d.m.Y H:i:s P',strtotime($task->updated_at)) }}</p></div>
            </div>

            <a class="btn btn-default" href="{{ url('/project/' .$task->projectid .'/tasks')}}" >Back</a>
            <a class="btn btn-default" href="{{ url('/tasks/' .$task->id .'/edit')}}" >Edit</a>
        </div>

            <div class="row">

                <div class="col-md-8">
                    <h3>Comments</h3>

                    <div>
                        @foreach($task->comments as $comment)

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{$comment->created_at}} | {{$comment->user->name}}
                                </div>
                                <div class="panel-body">
                                    {{$comment->comment}}
                                </div>
                            </div>

                        @endforeach


                        <form class="form-horizontal" method="post" action="{{url('/tasks/'.$task->id.'/comment')}}">
                            {{ csrf_field() }}
                            <div class="form-group" style="position:relative">
                                <div class="col-sm-10">
                                    <label class="control-label">New Comment</label>
                                    <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-bottom-right" style="">
                                    <button class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>


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
                                <td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#confirmdelete" data-exptimeid="{{$exptime->id}}" ><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                        @endforeach

                    </table>

                    <form class="form-horizontal form-addtime" method="post" action="{{url('/tasks/'.$task->id.'/addtime')}}" >
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="col-sm-6 {{count($errors->get('expdate'))>0 ? 'has-error' : ''}}">

                                <label class="control-label" for="expdate">Date</label>
                                <div class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" name="expdate" id="expdate" size="8"
                                           value=""/>
                                    <span class="input-group-btn"><button type="button" class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-th"></span></button></span>
                                </div>
                                @if (count($errors->get('expdate')) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('expdate') as $error )
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            <div class="col-sm-6 {{ count($errors->get('exptime'))>0 ? 'has-error' : '' }} ">

                                <label class="control-label">Expended Time (h)</label>
                                <input class="form-control" type="text" name="exptime" id="exptime" maxlength="5"
                                       size="5"/>
                                @if (count($errors->get('exptime')) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->get('exptime') as $error )
                                        {{$error}}
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 {{ count($errors->get('expdescription'))>0 ? 'has-error' : ''  }}">
                                <label class="control-label">Description</label>
                                <input class="form-control" type="text" name="expdescription" id="expdescription"
                                       placeholder="description" size="40"/>

                                @if (count($errors->get('expdescription')) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('expdescription') as $error )
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif

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

    <div class="modal fade" id="confirmdelete" role="dialog" aria-labelledby="confirmdeleteLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    Delete Expended Time Entry?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="delete">Delete</button>
                </div>
                <input type="hidden" name="exptimeid" id="exptimeid">
            </div>
        </div>
    </div>
    <script>
        $('.date').datepicker({autoclose: true, clearBtn: true,
            language: 'en'
        });
    </script>

    <script>
        $('#confirmdelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var exptimeid = button.data('exptimeid');
            var modal = $(this);
            modal.find('#exptimeid').val(exptimeid);
        });

        $('#delete').on('click', function() {
            var id = $('#confirmdelete #exptimeid').val();
            jQuery.post('{{url('/tasks/time/')}}'+'/'+id, {_method: 'DELETE', _token: '{{csrf_token()}}' }, function(){
                location.reload(true);
            } );
        });
    </script>

@endsection
