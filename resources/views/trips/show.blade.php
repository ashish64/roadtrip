<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Details for your trip
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col">
                        <div class="mt-4 flex justify-between">
                           <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $data->title }}
                           </h3>
                            @can('update', $data)
                            <a href="{{ route('trips.edit', $data) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                            rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                             focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
                             focus:ring-offset-2 transition ease-in-out duration-150'">
                                Edit
                            </a>
                            @endcan
                        </div>
                        <div class="mt-4">
                            <p>
                                {{ $data->description }}
                            </p>

                        </div>
                            <hr class="my-4">
                        <div class="mt-4">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                Users invited to this trip
                            </h3>
                            <ul class="flex mt-4 gap-5 flex-wrap">
                                @foreach($data->users as $user)
                                    <li class="rounded-full bg-gray-500 px-4 py-1 text-sm font-semibold text-white">
                                        {{ $user->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                Submit your idea here
                            </h3>
                            <form method="POST" action="{{ route('trips.suggestions.store', $data) }}">
                                @csrf
                                <div>
                                    <x-textarea-input id="description" class="block mt-1 w-full p-1"
                                                      name="description">
                                        {{ old('description') }}
                                    </x-textarea-input>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="mt-4 self-end">
                                    <x-primary-button >
                                        Submit your idea
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>

                        <div class="mt-4">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                Suggestions submitted for the trip
                            </h3>

                            <div class="flex flex-col gap-y-3 mt-3">
                                @foreach($data->suggestions as $suggestion)
                                <div class="p-2 border-gray-500 border rounded hover:bg-gray-100 flex gap-2">
                                    <div class="flex gap-x-2">
                                        <a href="{{ route('suggestions.vote', $suggestion) }}?type=up">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                            </svg>

                                        </a>
                                        <span>{{ $suggestion->up_votes_count }}</span>
                                        <a href="{{ route('suggestions.vote', $suggestion) }}?type=down">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                            </svg>
                                        </a>
                                        <span>{{ $suggestion->down_votes_count }}</span>
                                    </div>
                                    <p class="grow">
                                        {{ $suggestion->description }}
                                    </p>
                                    @can('update', $data)
                                    <div class="flex gap-x-3">
                                        <span>
                                            <a>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                </svg>
                                            </a>

                                        </span>
                                        <span>
                                            <a href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                    @endcan
                                </div>
                                 @endforeach
                            </div>

                        </div>


                    </div>

            </div>
        </div>

    </div>
</x-app-layout>
