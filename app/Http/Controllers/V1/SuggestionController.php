<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestionRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;

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
}
