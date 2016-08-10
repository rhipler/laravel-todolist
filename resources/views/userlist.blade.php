@extends('layouts.page')

@section('title','TODO List - Users')


@section('content')
    <div class="page-header">
        <h2>Users</h2>
    </div>

    <div class="table-responsive">
        <table class="table userlist table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>created at</th>
                <th>Updated at</th>
                <th></th>
            </tr>

            @foreach ($users as $row )
                <tr class="">
                    <td class="text-left"><a class="" href="{{url('/users/' .$row->id .'/edit') }}">{{ $row->name }}</a></td>
                    <td class="text-left"><a class="" href="{{url('/users/' .$row->id .'/edit') }}">{{ $row->email }}</a></td>
                    <td class="text-left"> {{ $row->role->name }}</td>
                    <td> {{ $row->created_at ? date('d.m.Y', strtotime($row->created_at)) : '' }} </td>
                    <td> {{ $row->updated_at ? date('d.m.Y', strtotime($row->updated_at)) : '' }} </td>
                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#confirmdelete" data-username="{{$row->email}}" data-userid="{{$row->id}}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a></td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="btnbar">
        {{ $users->links()  }}

        <a class="btn btn-primary" href="{{url('users/create' )}}">New User</a>
    </div>

    <div class="modal fade" id="confirmdelete" role="dialog" aria-labelledby="confirmdeleteLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    Delete User "<span id="username"></span>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="delete">Delete</button>
                </div>
                <input type="hidden" name="userid" id="userid">
            </div>
        </div>
    </div>
    <script>
        $('#confirmdelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var username = button.data('username');
            var userid = button.data('userid');
            var modal = $(this);
            modal.find('#username').text(username);
            modal.find('#userid').val(userid);
        })

        $('#delete').on('click', function() {
            var id = $('#confirmdelete #userid').val();
            jQuery.post('{{url('/users/')}}'+'/'+id, {_method: 'DELETE', _token: '{{csrf_token()}}' }, function() {
            } )
            .always(function() {
                location.reload(true);
            });
        });
    </script>
@endsection