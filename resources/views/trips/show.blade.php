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
                        <div class="mt-4">
                           <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $trip->title }}
                           </h3>
                        </div>
                        <div class="mt-4">
                            <p>
                                {{ $trip->description }}
                            </p>

                        </div>

                        </div>
                    </div>
            </div>
        </div>

    </div>
</x-app-layout>
