<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestionRequest;
use App\Models\Suggestion;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Trip $trip, SuggestionRequest $suggestionRequest): RedirectResponse
    {
        $suggestion = [
            'description' => $suggestionRequest['description'],
            'user_id' => auth()->id(),
        ];

        $trip->suggestions()->create($suggestion);

        return redirect()->route('trips.show', ['trip' => $trip]);
    }

    public function vote(Suggestion $suggestion, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:up,down',
        ]);

        $suggestion->vote()->updateOrCreate([
            'user_id' => auth()->id(),
            'suggestion_id' => $suggestion->id,
        ], $validated);

        return redirect()->back();
    }

    public function status(Suggestion $suggestion, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:approved,rejected',
            ]);

        $suggestion->update(['status' => $validated['type']]);

        return redirect()->back();
    }
}
