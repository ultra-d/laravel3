<?php

namespace App\Constants;

use Illuminate\Contracts\Support\Arrayable;

class PaymentStatus implements Arrayable
{
    
    public const PENDING='PENDING';
    public const REJECTED='REJECTED';
    public const APPROVED='APPROVED';
    
    public function toArray(): array
    {
        return [
            self::PENDING,
            self::REJECTED,
            self::APPROVED
        ];
    }
}
