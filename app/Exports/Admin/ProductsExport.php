<?php

namespace App\Exports\Admin;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, withHeadings, ShouldAutoSize, ShouldQueue
{
    use Exportable;

    protected array $export;

    public function __construct(array $export)
    {
        $this->export = $export;
    }

    public function headings(): array
    {
        return [
            'Product ID',
            'Category ID',
            'Code',
            'Title',
            'Slug',
            'Description',
            'Price',
            'Quantity',
            'Status',
        ];
    }

    public function query()
    {
        $dateFrom = $this->export['dateFrom'];
        $dateTo = $this->export['dateTo'];
        $status = $this->export['status'];

        return
            Product::select('id', 'category_id', 'code', 'title', 'slug', 'description', 'price', 'quantity', 'status')
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->whereIn('status', $this->status($status));
    }

    private function status(string $status)
    {
        if ($status == 'status') {
            return [0, 1];
        } else {
            return [$status];
        }
    }
}
