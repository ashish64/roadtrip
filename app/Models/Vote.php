<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    //
    protected $fillable = ['type', 'user_id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }
}
