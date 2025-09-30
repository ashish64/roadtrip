<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl">Road Trips you own</h2>

                    <div class="mt-4 flex flex-col">
                        @foreach($trips['owns'] as $trip)
                        <a href="{{ route('trips.show', $trip) }}"
                           @class([
                                     "p-2 border-gray-500 border rounded hover:bg-gray-100 my-2" => $trip->status === "active",
                                     "p-2 opacity-50  border-gray-500 border rounded hover:bg-gray-100 my-2" => $trip->status === "completed"
                                ])>{{ $trip->title }}
                            @if( $trip->status === "completed") - COMPLETED @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl">Road Trips you are invited to</h2>

                    <div class="mt-4 flex flex-col">
                        @foreach($trips['invited'] as $trip)
                            <a href="{{ route('trips.show', $trip) }}"
                                @class([
                                          "p-2 border-gray-500 border rounded hover:bg-gray-100 my-2" => $trip->status === "active",
                                          "p-2 opacity-50  border-gray-500 border rounded hover:bg-gray-100 my-2" => $trip->status === "completed"
                                     ])>{{ $trip->title }}
                                @if( $trip->status === "completed") - COMPLETED @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
