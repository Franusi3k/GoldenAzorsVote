<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PollRound extends Model
{
    protected $fillable = [
        'poll_id',
        'title',
        'description',
        'max_votes',
        'position',
    ];

    protected $casts = [
        'max_votes' => 'integer',
        'position' => 'integer',
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(PollRoundOption::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position');
    }

    public function allowsMultipleVotes(): bool
    {
        return $this->max_votes > 1;
    }
}
