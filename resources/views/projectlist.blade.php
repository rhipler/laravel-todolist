<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight ">Projects</h2>
    </x-slot:header>

    <div class="overflow-x-auto">
        <table class="w-full table projectlist">
            <tr class="bg-slate-300">
                <th class="text-left py-2.5 ">Title</th>
                <th></th>
                <th class="text-left">Description</th>
                <th class="w-32"></th>
            </tr>

            @foreach ($projects as $row )
                <tr class="odd:bg-gray-100 even:bg-transparent hover:bg-gray-200">
                    <td class="text-left"><a class="text-blue-500" href="{{url('project/'.$row->id.'/tasks')}}">{{ $row->name }}</a>   </td>
                    <td> <x-link-button href="{{url('project/'.$row->id.'/tasks')}}">Tasks</x-link-button> </td>
                    <td class="text-left"> {{ $row->description }}</td>
                    <td class="py-2 text-right">
                        <x-link-button :href="url('project/' .$row->id .'/edit') " class="align-middle" >
                            <x-icon-edit></x-icon-edit>
                        </x-link-button>

                        <x-danger-button class="ml-2 align-middle" type="button" x-data
                             x-on:click.prevent="$dispatch('set-modal-data',{action: '{{url('project').'/'.$row->id}}', projectname: '{{$row->name}}'} );  $dispatch('open-modal', 'confirmdelete')" >
                            <x-icon-trash></x-icon-trash>
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="mt-5">
        <x-link-button :href="url('project/create')" >New Project</x-link-button>
    </div>


    <x-modal name="confirmdelete" maxWidth="md">
        <form method="post" x-bind:action="action" class="p-6" x-data="{action: '', projectname:''}"
              x-on:set-modal-data.window="action=$event.detail.action; projectname=$event.detail.projectname ">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete Project "<span x-text="projectname"></span>"?
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
