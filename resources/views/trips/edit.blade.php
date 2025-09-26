<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update you trip plan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('trips.update', $trip) }}">
                    @csrf
                    @method('PUT')
                    <div class="p-6 text-gray-900 flex flex-col">
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full"
                                          type="text"
                                          value="{{ old('title', $trip->title) }}"
                                          name="title"
                            />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />

                            <x-textarea-input id="description" class="block mt-1 w-full p-1"
                                              name="description">
                                {{ old('description', $trip->description) }}
                            </x-textarea-input>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />


                        </div>
                        <div class="mt-4 flex gap-x-4">
                            <x-input-label for="description" value="Active" />
                            <input id="active" class="block mt-1"
                                          value="active"
                                          type="radio"
                                          name="status"
                                          @checked(old('status', $trip->status))
                            >
                            <x-input-label for="description" value="Completed" />
                            <input id="completed" class="block mt-1"
                                   value="completed"
                                   type="radio"
                                   name="status"
                                {{ old('status') == 'completed' ? 'checked' : ''}}
                            >
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
