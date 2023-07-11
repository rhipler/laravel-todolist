<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight "> {{ $heading }} </h2>
    </x-slot:header>


    <div class="overflow-x-auto">
        <table class="table w-full tasklist">
            <tr class="bg-slate-300">
                <th class="text-left">Title</th>
                <th class="text-left">Description</th>
                <th class="text-left">Due date</th>
                <th></th>
            </tr>

            @foreach ($tasks as $row )
                <tr class="odd:bg-gray-100 even:bg-transparent hover:bg-gray-200">
                    <td class="text-left"><a class="text-blue-500" href="{{url('tasks/'.$row->id)}}">{{ $row->name }}</a></td>
                    <td class="text-left"> {{ $row->description }}</td>
                    <td> {{ $row->duedate ?  date('d.m.Y', strtotime($row->duedate)) : ''  }} </td>
                    <td class="py-2 text-right">
                        <x-danger-button class="ml-2 align-middle" type="button" x-data
                                 x-on:click.prevent="$dispatch('set-modal-data',{action: '{{url('/tasks/').'/'.$row->id}}', taskname: '{{$row->name}}'} );  $dispatch('open-modal', 'confirmdelete')" >
                            <x-icon-trash></x-icon-trash>
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="mt-5">
        {{ $tasks->links()  }}
        @if ($projectid != 0)
            <x-link-button :href="url('tasks/create/'.$projectid)" >New Task</x-link-button>
        @endif
    </div>

    <x-modal name="confirmdelete" maxWidth="md">
        <form method="post" x-bind:action="action" class="p-6" x-data="{action: '', taskname:''}"
              x-on:set-modal-data.window="action=$event.detail.action; taskname=$event.detail.taskname ">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete Task "<span x-text="taskname"></span>"?
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
