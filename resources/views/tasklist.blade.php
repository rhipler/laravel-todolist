@extends('layouts.page')

@section('title','TODO List - All tasks')


@section('content')
    <div class="page-header">
        <h2>All Tasks</h2>
    </div>

    <div class="table-responsive">
        <table class="table tasklist table-striped table-hover">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due date</th>
                <th></th>
            </tr>

            @foreach ($tasks as $row )
                <tr class="">
                    <td class="text-left"><a class="" href="{{url('tasks/'.$row->id.'/edit')}}">{{ $row->name }}</a></td>
                    <td class="text-left"> {{ $row->description }}</td>
                    <td> {{ $row->duedate ?  date('d.m.Y', strtotime($row->duedate)) : ''  }} {{$row->duedate}} </td>
                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#confirmdelete" data-taskname="{{$row->name}}" data-taskid="{{$row->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                        </a></td>
                </tr>
            @endforeach

        </table>

    </div>

    <div class="btnbar">
        {{ $tasks->links()  }}
        <a class="btn btn-primary" href="{{url('tasks/create')}}">New Task</a>
    </div>

    <div class="modal fade" id="confirmdelete" role="dialog" aria-labelledby="confirmdeleteLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    Delete Task "<span id="taskname"></span>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="delete">Delete</button>
                </div>
                <input type="hidden" name="taskid" id="taskid">
            </div>
        </div>
    </div>
    <script>
        $('#confirmdelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var taskname = button.data('taskname');
            var taskid = button.data('taskid');
            var modal = $(this);
            modal.find('#taskname').text(taskname);
            modal.find('#taskid').val(taskid);
        })

        $('#delete').on('click', function() {
            var id = $('#confirmdelete #taskid').val();

            jQuery.post('{{url('/tasks/')}}'+'/'+id, {_method: 'DELETE', _token: '{{csrf_token()}}' }, function(){
                location.reload(true);
            } );

            //$('#confirmdelete').modal('hide');
        });
    </script>
@endsection