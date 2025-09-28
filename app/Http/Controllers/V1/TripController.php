<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\User;
use App\Repositories\Contracts\TripRepositoryContract;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TripController extends Controller
{
    /**
     * @param  TripRepository  $trip
     */
    public function __construct(
        protected TripRepositoryContract $trip
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $trips = $this->trip->findAll();

        return view('trips.index', compact('trips'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $users = $this->getUsers();

        return view('trips.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $tripRequest): RedirectResponse
    {

        $trip = $this->trip->create($tripRequest->all());

        return redirect()->route('trips.show', ['trip' => $trip]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip): View
    {

        $data = $this->trip->findWithSuggestions($trip);

        return view('trips.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip): View
    {
        //
        $data = $this->trip->find($trip, 'users:id,name');
        $users = $this->getUsers();

        return view('trips.edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripRequest $tripRequest, Trip $trip): RedirectResponse
    {
        $this->trip->updateTrip($trip, $tripRequest->all());

        return redirect()->route('trips.show', ['trip' => $trip]);
    }

    /**
     * Caches users and retrieves them.
     *
     * @return Collection<int, User>
     */
    private function getUsers(): Collection
    {
        return Cache::remember('listableUsers', 3600, function () {
            return User::get(['id', 'name']);
        });
    }
}
