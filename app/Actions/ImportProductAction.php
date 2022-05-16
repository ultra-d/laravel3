<?php

namespace App\Actions;

use App\Imports\Admin\ProductsImport;
use App\Jobs\NotifyUserImportCompleted;
use Illuminate\Http\Request;

class ImportProductAction
{
    public function execute(Request $request): void
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:1024',
        ]);
        $file = $request->file('file');
        $user = auth()->user();

        (new ProductsImport($user))->queue($file)->chain([
            new NotifyUserImportCompleted($user),
        ]);
    }
}
