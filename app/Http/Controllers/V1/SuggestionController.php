<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestionRequest;
use App\Models\Suggestion;
use App\Models\Trip;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SuggestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @throws AuthorizationException
     */
    public function store(Trip $trip, SuggestionRequest $suggestionRequest): RedirectResponse
    {
        Gate::authorize('view', $trip);
        $suggestion = [
            'description' => $suggestionRequest['description'],
            'user_id' => auth()->id(),
        ];

        $trip->suggestions()->create($suggestion);

        return redirect()->route('trips.show', ['trip' => $trip]);
    }

    /**
     * This can and should be moved to its own controller
     *
     * @throws AuthorizationException
     */
    public function vote(Suggestion $suggestion, Request $request): RedirectResponse
    {
        Gate::authorize('view', $suggestion->trip);
        $validated = $request->validate([
            'type' => 'required|in:up,down',
        ]);

        $suggestion->vote()->updateOrCreate([
            'user_id' => auth()->id(),
            'suggestion_id' => $suggestion->id,
        ], $validated);

        return redirect()->back();
    }

    /**
     * @throws AuthorizationException
     */
    public function status(Suggestion $suggestion, Request $request): RedirectResponse
    {
        Gate::authorize('update', $suggestion->trip);
        $validated = $request->validate([
            'type' => 'required|in:approved,rejected',
        ]);

        $suggestion->update(['status' => $validated['type']]);

        return redirect()->back();
    }
}
