<?php

namespace App\Imports\Admin;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use App\Rules\ImportRule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation, WithEvents
{
    use Importable;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function model(array $row): Product
    {
        return new Product([
            'id' => $row['id'],
            'category_id' => $row['category_id'],
            'code' => $row['code'],
            'title' => $row['title'],
            'slug' => $row['slug'],
            'description' => $row['description'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'status' => $row['status'],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function () {
                $this->user->notify(new ImportHasFailedNotification());
            },
        ];
    }

    public function rules(): array
    {
        return ImportRule::toArray();
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
