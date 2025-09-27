<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    //
    protected $fillable = ['type', 'user_id'];

    /**
     * @return BelongsTo<User,$this>
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Suggestion,$this>
     */
    public function Suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }
}
