<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class PollRoundOption extends Model
{
    protected $fillable = [
        'poll_round_id',
        'label',
        'description',
        'content_type',
        'youtube_url',
        'image_path',
        'position',
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    public function round(): BelongsTo
    {
        return $this->belongsTo(PollRound::class, 'poll_round_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position');
    }
}
