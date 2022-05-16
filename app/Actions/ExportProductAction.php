<?php

namespace App\Actions;

use App\Exports\Admin\ProductsExport;
use App\Jobs\NotifyUserExportCompleted;
use Illuminate\Http\Request;

class ExportProductAction
{
    public function execute(Request $request): void
    {
        $user = auth()->user();
        $filePath = asset('storage/products.xlsx');
        $export = $request->toArray();
        (new ProductsExport($export))->queue('products.xlsx', 'public')->chain([
            new NotifyUserExportCompleted($user, $filePath),
        ]);
    }
}
