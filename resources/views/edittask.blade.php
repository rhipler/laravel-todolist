<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Edit Task</h2>
    </x-slot:header>

    <div>
        <form action="{{url('/tasks/'.$task->id)}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$task->id}}" />
            @method('put')

            <div class="mt-2">
                <x-input-label for="name" value="Name" />
                <x-text-input type="text" name="name" id="name" value="{{old('name',$task->name)}}"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="description" value="Description" />
                <textarea class="rounded-md" name="description" id="description" rows="4">{{old('description',$task->description)}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-2" >
                <x-input-label for="duedate" value="Due Date" />
                <x-text-input type="date" name="duedate" id="duedate" value="{{old('duedate', $task->duedate ? date('Y-m-d',strtotime($task->duedate)) : '') }}" />
                <x-input-error :messages="$errors->get('duedate')" class="mt-2" />
            </div>

            <div class="flex items-center mt-6">
                <x-input-label value="Created at" class="w-28 shrink-0" />
                <div class="flex-1 border border-gray-200 px-2 py-1">{{ date('d.m.Y H:i:s P',strtotime($task->created_at)) }}</div>
            </div>
            <div class="flex items-center mt-2">
                <x-input-label value="Created By" class="w-28 shrink-0" />
                <div class="flex-1 border border-gray-200 px-2 py-1">{{ $task->createdByUser->name}}</div>
            </div>
            <div class="flex items-center mt-2">
                <x-input-label value="Last Updated at" class="w-28 shrink-0" />
                <div class="flex-1 border border-gray-200 px-2 py-1">{{ date('d.m.Y H:i:s P',strtotime($task->updated_at)) }}</div>
            </div>

            <div class="mt-5">
                <x-link-secondary-button href="{{ url('/project/' .$task->projectid .'/tasks')}}" class="mr-4" >Cancel</x-link-secondary-button>
                <x-primary-button type="submit" >Save</x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
