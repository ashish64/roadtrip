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
                                {{ $data->title }} {{ $data->owner->name }}
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
                            <div>users goes here</div>
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
                                        create
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
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                                            </svg>
                                        </span>
                                        <span>total votes</span>
                                    </div>
                                    <p class="grow">
                                        {{ $suggestion->description }}
                                    </p>
                                    @can('update', $data)
                                    <div>
                                        <span>
                                            Approve
                                        </span>
                                        <span>
                                            Reject
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
