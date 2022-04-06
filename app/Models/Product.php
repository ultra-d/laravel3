<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'code', 'slug', 'description', 'price', 'quantity', 'disable_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isDisabled(): bool
    {
        return ! $this->isEnabled();
    }

    public function isEnabled(): bool
    {
        return (bool) $this->status;
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class);
    }
    //query scope
    public function scopeTitle($query, $title)
    {
        if ($title) {
            return $query->where('title', 'LIKE', "%$title%");
        }
    }

    public function scopeCategoryId($query, $category_id)
    {
        if ($category_id) {
            return $query->where('title', 'LIKE', "%$category_id%");
        }
    }
}
