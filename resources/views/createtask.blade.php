<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Create new task</h2>
    </x-slot:header>

    <div>
        <form action="{{url('/tasks')}}" method="post">
            @csrf

            <div class="">
                <x-input-label for="name" value="Name" />
                <x-text-input type="text" class=""   name="name" id="name" :value="old('name')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="description" value="Description" />
                <textarea class="rounded-md" name="description" id="description" rows="4">{{old('description')}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="duedate" value="Due Date"/>
                <x-text-input type="date" name="duedate" :value="old('duedate')" />
                <x-input-error :messages="$errors->get('duedate')" class="mt-2" />
            </div>
            <input type="hidden" name="projectid" value="{{$projectid}}" />

            <div class="mt-5">
                <x-link-secondary-button href="{{ url('/project/'.$projectid.'/tasks')}}" >Cancel</x-link-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>
