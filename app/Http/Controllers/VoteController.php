<?php

namespace App\Http\Controllers;

use App\Enums\VoteType;
use App\Models\Suggestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class VoteController extends Controller
{
    public function vote(Suggestion $suggestion, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', new Enum(VoteType::class)],
        ]);

        $suggestion->vote()->updateOrCreate([
            'user_id' => auth()->id(),
            'suggestion_id' => $suggestion->id,
        ], $validated);

        return redirect()->back();
    }
}
