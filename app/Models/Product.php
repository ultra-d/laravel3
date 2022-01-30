<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'code', 'url', 'description', 'price', 'quantity', 'disable_at'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function isDisabled(): bool
    {
        return ! $this->isEnabled();
    }

    public function isEnabled(): bool
    {
        return (bool) $this->status;
    }
}
