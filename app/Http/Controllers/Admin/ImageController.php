<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;

class ImageController extends Controller
{
    public function destroy(Image $image): RedirectResponse
    {
        $product = $image->product;
        $image->deleteFromDisk();
        $image->delete();

        return redirect()->route('admin.products.edit', $product);
    }
}
