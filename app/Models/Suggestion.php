<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    //

    protected $fillable = ['description', 'status', 'user_id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
