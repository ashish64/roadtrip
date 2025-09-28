<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Trip;
use App\Repositories\Contracts\TripRepositoryContract;
use Illuminate\Support\Collection;

class TripRepository implements TripRepositoryContract
{
    /**
     * @return array<string, Collection<int, Trip>>
     */
    public function findAll(): array
    {
        $user = auth()->user()->load(['owns', 'trips']);

        return [
            'owns' => $user->owns,
            'invited' => $user->trips,
        ];
    }

    public function findWithSuggestions(Trip $trip): Trip
    {
        return $trip->load([
            'suggestions' => function ($query) {
                $query->withCount([
                    'vote as up_votes_count' => function ($q) {
                        $q->where('type', 'up');
                    },
                    'vote as down_votes_count' => function ($q) {
                        $q->where('type', 'down');
                    },
                ]);
            },
            'users:name',
        ]);
    }

    public function find(Trip $trip, string $relation = ''): Trip
    {
        if ($relation != '') {
            return $trip->load($relation);
        }

        return $trip;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Trip
    {
        $trip = auth()->user()->owns()->create($data);
        $trip->users()->attach($data['users']);

        return $trip;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function updateTrip(Trip $trip, array $data): Trip
    {
        $trip->update($data);
        $trip->users()->sync($data['users']);

        return $trip;
    }
}
