<?php

namespace App\Observers;

use App\Models\Suggestion;
use Illuminate\Support\Facades\Log;

class SuggestionObserver
{
    /**
     * Handle the Suggestion "created" event.
     */
    public function created(Suggestion $suggestion): void
    {
        //
        $owner = $suggestion->trip->owner;

        Log::notice($owner->name.' A new suggestion was created');
    }

    /**
     * Handle the Suggestion "updated" event.
     */
    public function updated(Suggestion $suggestion): void
    {
        //
    }

    /**
     * Handle the Suggestion "deleted" event.
     */
    public function deleted(Suggestion $suggestion): void
    {
        //
    }

    /**
     * Handle the Suggestion "restored" event.
     */
    public function restored(Suggestion $suggestion): void
    {
        //
    }

    /**
     * Handle the Suggestion "force deleted" event.
     */
    public function forceDeleted(Suggestion $suggestion): void
    {
        //
    }
}
