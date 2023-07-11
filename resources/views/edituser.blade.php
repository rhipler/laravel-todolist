<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight ">Edit User</h2>
    </x-slot:header>

    <div>
        <form action="{{url('/users/'.$user->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$user->id}}" />

            <div class="mt-2">
                <x-input-label for="name" value="Name" />
                <x-text-input type="text" name="name" id="name"  :value="old('name', $user->name)" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="email" value="Email" />
                <x-text-input type="email" name="email" id="email" :value="old('email', $user->email)"  />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Change Password" />
                <x-text-input type="password" name="password" id="password"  />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="passwordrepeat" value="Password (repeat)" />
                <x-text-input type="password"  name="passwordrepeat" id="passwordrepeat" />
                <x-input-error :messages="$errors->get('passwordrepeat')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-input-label for="role_id" value="Role" />
                <select id="role_id" name="role_id" class="border-gray-300 rounded-md">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" @if ($role->id==old('role_id',$user->role_id)) selected="selected" @endif> {{$role->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5">
                <x-link-secondary-button :href="url('/users')" >Cancel</x-link-secondary-button>
                <x-primary-button type="submit">Save</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
