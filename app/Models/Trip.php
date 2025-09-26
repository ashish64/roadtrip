<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    /**
     * A trip belongs to its creator
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return HasMany
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }
}
