<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Trip;
use Illuminate\Support\Collection;

interface TripRepositoryContract
{
    /**
     * @return array<string, Collection<int, Trip>>
     */
    public function findAll(): array;

    public function find(Trip $trip, string $relation = ''): Trip;

    public function findWithSuggestions(Trip $trip): Trip;

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Trip;

    /**
     * @param  array<string, mixed>  $data
     */
    public function updateTrip(Trip $trip, array $data): Trip;
}
