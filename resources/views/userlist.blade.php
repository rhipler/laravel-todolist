<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Users</h2>
    </x-slot:header>


    <div class="overflow-x-auto">
        <table class="w-full table userlist">
            <tr class="bg-slate-300">
                <th class="text-left py-2.5">Name</th>
                <th class="text-left">Email</th>
                <th class="text-left">Role</th>
                <th class="text-left">Created at</th>
                <th class="text-left">Updated at</th>
                <th></th>
            </tr>

            @foreach ($users as $row )
                <tr class="odd:bg-gray-100 even:bg-transparent hover:bg-gray-200">
                    <td class="text-left"><a class="text-blue-500" href="{{url('/users/' .$row->id .'/edit') }}">{{ $row->name }}</a></td>
                    <td class="text-left"><a class="text-blue-500" href="{{url('/users/' .$row->id .'/edit') }}">{{ $row->email }}</a></td>
                    <td class="text-left"> {{ $row->role->name }}</td>
                    <td> {{ $row->created_at ? date('d.m.Y', strtotime($row->created_at)) : '' }} </td>
                    <td> {{ $row->updated_at ? date('d.m.Y', strtotime($row->updated_at)) : '' }} </td>
                    <td class="py-2">
                        <x-danger-button type="button" x-data
                                 x-on:click.prevent="$dispatch('set-modal-data',{action: '{{url('/users/').'/'.$row->id}}', username: '{{$row->email}}'}); $dispatch('open-modal', 'confirmdelete');">
                            <x-icon-trash />
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="mt-5">
        {{ $users->links()  }}
        <x-link-button class="mt-2" :href="url('users/create')">New User</x-link-button>
    </div>


    <x-modal name="confirmdelete" maxWidth="md">
        <form method="post" x-bind:action="action"  class="p-6" x-data="{username: '', action: ''}"
              x-on:set-modal-data.window="action=$event.detail.action; username=$event.detail.username" >
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete User "<span x-text="username"></span>"?
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button type="submit" class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
