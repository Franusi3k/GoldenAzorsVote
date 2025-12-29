<?php

namespace App\Domain\Poll;

class PollOptionType
{
    public const TEXT = 'text';
    public const IMAGE = 'image';
    public const VIDEO = 'video';

    public static function all(): array
    {
        return [
            self::TEXT,
            self::IMAGE,
            self::VIDEO,
        ];
    }
}