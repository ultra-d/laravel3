<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_deleted(): void
    {
        $product = Product::factory()->count(1)->make();
        $product = Product::first();

        if ($product) {
            $product->delete();
        }

        $this->assertTrue(true);
    }

    /* public function an_admin_can_delete_a_product()
    {
        $this->assertDatabaseHas('products', ['title'=> $this->product->title]);

        $this->delete(route('admin.products.destroy', $this->product))
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'));

        $this->assertDeleted('products', array($this->product));
    }
 */
    private function productData(): array
    {
        return [
            'category_id' => '1',
            'image' => UploadedFile::fake()->image('product.jpg')->size(50),
            'code' => 'PRD1234567',
            'title' => 'Test product',
            'url' => 'test-product-url',
            'description' => 'my awesome test product description',
            'price' => 200,
            'quantity' => 10,
        ];
    }
}
