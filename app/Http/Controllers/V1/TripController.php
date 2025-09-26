<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
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
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $tripRequest): RedirectResponse
    {
        //
        $trip = auth()->user()->owns()->create($tripRequest->validated());

        return redirect()->route('trips.show', ['trip' => $trip]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip): View
    {
        return view('trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip): View
    {
        //
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripRequest $tripRequest, Trip $trip): RedirectResponse
    {
        //
        $trip->update($tripRequest->validated());

        return redirect()->route('trips.show', ['trip' => $trip]);
    }
}
