<?php

namespace App\Domain\Poll;

class PollType
{
    public const OPEN = 'open';
    public const CLOSED = 'closed';

    public static function all(): array
    {
        return [
            self::OPEN,
            self::CLOSED,
        ];
    }
}