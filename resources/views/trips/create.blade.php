<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create you trip plan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('trips.store') }}">
                    @csrf
                    <div class="p-6 text-gray-900 flex flex-col">
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full"
                                          type="text"
                                          value="{{ old('title') }}"
                                          name="title"
                                           />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />

                            <x-textarea-input id="description" class="block mt-1 w-full p-1"
                                              name="description">
                                {{ old('description') }}
                            </x-textarea-input>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />


                        </div>
                        <div class="mt-4 flex gap-x-4">
                            <x-input-label for="description" value="Active" />
                            <x-text-input id="status" class="block mt-1"
                                          value="active"
                                          type="radio"
                                          name="status" />
                            <x-input-label for="description" value="Completed" />
                            <x-text-input id="status" class="block mt-1 "
                                          value="completed"
                                          type="radio"
                                          name="status" />

                        </div>
                        <div class="mt-4">user list here</div>
                        <div class="mt-4 self-end">
                            <x-primary-button >
                                create
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
