@extends('layouts.page')

@section('title','TODO List - Projects')


@section('content')
    <div class="page-header">
        <h2>Projects</h2>
    </div>

    <div class="table-responsive">
        <table class="table projectlist table-striped table-hover">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>

            @foreach ($projects as $row )
                <tr class="">
                    <td class="text-left"><a class="" href="{{url('project/'.$row->id.'/edit')}}">{{ $row->name }}</a></td>
                    <td class="text-left"> {{ $row->description }}</td>
                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#confirmdelete" data-projectname="{{$row->name}}" data-projectid="{{$row->id}}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a></td>
                </tr>
            @endforeach

        </table>

    </div>

    <div class="btnbar">
        {{--  $projects->links()  --}}
        <a class="btn btn-primary" href="{{url('project/create')}}">New Project</a>
    </div>

    <div class="modal fade" id="confirmdelete" role="dialog" aria-labelledby="confirmdeleteLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    Delete Project "<span id="projectname"></span>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="delete">Delete</button>
                </div>
                <input type="hidden" name="projectid" id="projectid">
            </div>
        </div>
    </div>
    <script>
        $('#confirmdelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var projectname = button.data('projectname');
            var projectid = button.data('projectid');
            var modal = $(this);
            modal.find('#projectname').text(projectname);
            modal.find('#projectid').val(projectid);
        })

        $('#delete').on('click', function() {
            var id = $('#confirmdelete #projectid').val();

            jQuery.post('{{url('/project/')}}'+'/'+id, {_method: 'DELETE', _token: '{{csrf_token()}}' }, function(){
                location.reload(true);
            } );
        });
    </script>
@endsection