<?php

namespace App\Models;

use App\Domain\Poll\PollStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'poll_type',
        'status',
        'opens_at',
        'closes_at',
    ];

    protected $casts = [
        'opens_at' => 'datetime',
        'closes_at' => 'datetime'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(PollRound::class);
    }

    public function isActive(): bool
    {
        return $this->status === PollStatus::ACTIVE;
    }

    public function isClosed(): bool
    {
        return $this->status === PollStatus::CLOSED;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', PollStatus::ACTIVE);
    }
}
