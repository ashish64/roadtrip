<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\SuggestionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(SuggestionObserver::class)]
class Suggestion extends Model
{
    protected $fillable = ['description', 'status', 'user_id'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Trip, $this>
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * @return HasMany<Vote, $this>
     */
    public function vote(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
