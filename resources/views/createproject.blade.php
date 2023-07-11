<x-app-layout>

    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Create New Project</h2>
    </x-slot:header>

    <div>
        <form action="{{url('/project')}}" method="post">
            @csrf

            <div class="">
                <x-input-label for="name" value="Name" />
                <x-text-input class="mt-1 w-ful"  name="name" id="name" type="text" :value="old('name')"  />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" value="Description" />
                <textarea class="mt-2 rounded-md" name="description" id="description" rows="4">{{old('description')}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-5">
                <x-link-secondary-button :href="url('/project')" >Cancel</x-link-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
