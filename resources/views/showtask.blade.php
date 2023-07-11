<x-app-layout>

    <x-slot:header>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">Task</h2>
    </x-slot:header>

    <div>
        @if (count($errors) > 0)
            <div class="text-red-600 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <div class="mt-2 flex items-center">
                <x-input-label value="Name" class="w-28 shrink-0" />
                <div class="flex-1 border border-gray-200 px-2 py-1">{{$task->name}}</div>
            </div>
            <div class="mt-2 flex items-center">
                <x-input-label value="Description" class="w-28 shrink-0" />
                <div class="flex-1 border border-gray-300 px-2 py-1" style="white-space: pre-wrap" > {{$task->description}}</div>
            </div>
            <div class="mt-2 flex items-center">
                <x-input-label value="Due Date" class=" w-28 shrink-0" />
                <div class="border border-gray-300 w-56 px-2 py-1"> {{ $task->duedate ? date('Y-m-d',strtotime($task->duedate)) : '' }} </div>
            </div>

            <div class="mt-2 flex items-center">
                <x-input-label value="Created at" class="w-28 shrink-0" />
                <div class="border border-gray-300 w-56 px-2 py-1"> {{ date('d.m.Y H:i:s P',strtotime($task->created_at)) }} </div>
            </div>
            <div class="mt-2 flex items-center">
                <x-input-label value="Created By" class=" w-28 shrink-0" />
                <div class="border border-gray-300 w-56 px-2 py-1"><p class="border-panel">{{ $task->createdByUser->name}}</p></div>
            </div>
            <div class="mt-2 flex items-center">
                <x-input-label value="Last Updated at" class=" w-28 shrink-0" />
                <div class="border border-gray-300 w-56 px-2 py-1">{{ date('d.m.Y H:i:s P',strtotime($task->updated_at)) }}</div>
            </div>

            <div class="mt-5">
                <x-link-secondary-button  href="{{ url('/project/' .$task->projectid .'/tasks')}}" class="mr-4" >Back</x-link-secondary-button>
                <x-link-button  href="{{ url('/tasks/' .$task->id .'/edit')}}" >Edit</x-link-button>
            </div>
        </div>

        <div class="md:flex mt-8">

            <div class="w-full md:w-[24rem] md:flex-auto md:mr-8 mb-8 ">
                <h3 class="mb-2 font-semibold text-2xl text-gray-800">Comments</h3>

                @foreach($task->comments as $comment)
                    <div class="mb-4 border border-gray-200 rounded">
                        <div class="bg-gray-100 py-2 px-4 rounded-t">
                            {{$comment->created_at}} | {{$comment->user->name}}
                        </div>
                        <div class="px-4 py-2" style="white-space: pre-wrap">{{ $comment->comment }}</div>
                    </div>
                @endforeach

                <form class="mt-6" method="post" action="{{url('/tasks/'.$task->id.'/comment')}}">
                    @csrf
                    <div class="flex items-end" style="">
                        <div class="w-full pr-2">
                            <x-input-label for="comment" value="New Comment" />
                            <textarea id="comment" name="comment" class="w-full rounded-md" rows="3"></textarea>
                            <x-input-error :messages="$errors->get('comment')"  />
                        </div>
                        <div class="basis-4 mt-3 flex-grow text-right" style="">
                            <x-primary-button type="submit">Add</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-80 md:flex-auto">
                <h3 class="mb-2 font-semibold text-2xl text-gray-800">Expended Time</h3>

                <table style="width:100%" class="table">
                    @foreach($task->expendedtimes as $exptime)
                        <tr class="odd:bg-gray-100 even:bg-transparent hover:bg-gray-200" >
                            <td style="min-width:90px">{{$exptime->date}} {{$exptime->user->name}} </td>
                            <td style="min-width:90px; word-break: break-all">{{$exptime->description}}</td>
                            <td style="min-width:60px;">{{$exptime->time}} h</td>
                            <td class="py-2 text-right">
                                <x-danger-button type="button" x-data
                                    x-on:click.prevent="$dispatch('set-modal-data',{action: '{{url('/tasks/time',$exptime->id) }}'}); $dispatch('open-modal', 'confirmdelete')"><x-icon-trash></x-icon-trash>
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <form class="form-addtime" method="post" action="{{url('/tasks/'.$task->id.'/addtime')}}" >
                    @csrf
                    <div class="mt-6 flex">
                        <div class="pr-4  {{count($errors->get('expdate'))>0 ? 'has-error' : ''}}">
                            <x-input-label for="expdate" value="Date" />
                            <x-text-input type="date" name="expdate" id="expdate" :value="old('expdate')" />
                            <x-input-error :messages="$errors->get('expdate')"  />
                        </div>

                        <div class=" {{ count($errors->get('exptime'))>0 ? 'has-error' : '' }} ">
                            <x-input-label for="exptime" value="Expended Time (h)" />
                            <x-text-input type="text" name="exptime" id="exptime" :value="old('exptime')" maxlength="5" size="5" />
                            <x-input-error :messages="$errors->get('exptime')" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class=" {{ count($errors->get('expdescription'))>0 ? 'has-error' : ''  }}">
                            <x-input-label for="expdescription" value="Description" />
                            <x-text-input type="text" name="expdescription" id="expdescription" :value="old('expdescription')"  placeholder="description" class="w-full" />
                            <x-input-error :messages="$errors->get('expdescription')" class="mt-1" />
                        </div>
                    </div>

                    <div class="mt-2 text-right">
                        <x-primary-button type="submit" >Add</x-primary-button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <x-modal name="confirmdelete" maxWidth="md">
        <form method="post" x-bind:action="action" class="p-6" x-data="{action: ''}"
              x-on:set-modal-data.window="action=$event.detail.action">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete Expended Time Entry?
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-danger-button class="ml-3">{{ __('Delete') }}</x-danger-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
