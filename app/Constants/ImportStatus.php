<?php

namespace App\Constants;

use Illuminate\Contracts\Support\Arrayable;

class ImportStatus implements Arrayable
{
    public const IN_PROGRESS = 'IN_PROGRESS';
    public const FAILED = 'FAILED';
    public const DONE = 'DONE';

    public function toArray(): array
    {
        return [
            self::IN_PROGRESS,
            self::FAILED,
            self::DONE,
        ];
    }
}
