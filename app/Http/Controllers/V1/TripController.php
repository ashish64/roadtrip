<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // trips i own
        $trips = [
            'owns' => auth()->user()->owns,
        ];

        return view('trips.index', compact('trips'));

        // trips im associated with

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $users = Cache::remember('listableUsers',3600 , function () {
            return User::get(['id','name']);
        });
        return view('trips.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $tripRequest): RedirectResponse
    {
        //
        $trip = auth()->user()->owns()->create($tripRequest->validated());
        $trip->users()->attach($tripRequest->users);

        return redirect()->route('trips.show', ['trip' => $trip]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip): View
    {
        $data = $trip->load([
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
        ]);

        return view('trips.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip): View
    {
        //
        Gate::authorize('update', $trip);
        $trip = $trip->load('users:id,name');
        $users = Cache::remember('listableUsers',3600 , function () {
            return User::get(['id','name']);
        });

        return view('trips.edit', compact('trip', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripRequest $tripRequest, Trip $trip): RedirectResponse
    {
        //
        Gate::authorize('update', $trip);
        $trip->update($tripRequest->validated());
        $trip->users()->attach($tripRequest->users);

        return redirect()->route('trips.show', ['trip' => $trip]);
    }
}
