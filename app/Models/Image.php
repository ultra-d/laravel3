<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function url(): string
    {
        return Storage::disk(config('filesystems.images_disk'))->url("{$this->product_id}/{$this->file_name}");
    }
    public function deleteFromDisk(): bool
    {
        return Storage::disk(config('filesystems.images_disk'))->delete("{$this->product_id}/{$this->file_name}");
    }
}
