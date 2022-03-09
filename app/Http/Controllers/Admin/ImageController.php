<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
