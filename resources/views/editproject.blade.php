
<x-app-layout>

    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Edit Project</h2>
    </x-slot:header>

    <div>
        <form action="{{url('/project/'.$project->id)}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$project->id}}" />
            @method('put')

            <div class="">
                <x-input-label for="name" value="Name" />
                <x-text-input class="mt-1 w-ful"  name="name" id="name" type="text" :value="old('name',$project->name)" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" value="Description" />
                <textarea class="mt-2 rounded-md" name="description" id="description" rows="4">{{old('description',$project->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-input-label value="Created at" /> {{ $project->created_at }}
            </div>

            <div class="mt-2">
                <x-input-label value="Last updated at" /> {{ $project->updated_at }}
            </div>

            <div class="mt-5">
                <x-link-secondary-button :href="url('/project')" class="mr-4" >Cancel</x-link-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
