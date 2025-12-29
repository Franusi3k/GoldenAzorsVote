<?php

namespace App\Domain\Poll;

class PollStatus
{
    public const ACTIVE = 'active';
    public const CLOSED = 'closed';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::CLOSED,
        ];
    }
}