<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestionRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Trip $trip, SuggestionRequest $suggestionRequest)
    {
        $suggestion = [
            'description' =>  $suggestionRequest['description'],
            'user_id' => auth()->id(),
        ];

        $trip->suggestions()->create($suggestion);
        return redirect()->route('trips.show', ['trip' => $trip]);
    }

}
