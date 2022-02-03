<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_can_delete_product(): void
    {
        $product = $this->productData();
        $this->withoutExceptionHandling();

        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();

        $response = $this->actingAs($user)->delete(route('admin.products.destroy', compact('product')));
        $response->assertRedirect(route('admin.products.index'));

        $response->assertStatus(200);
    }

    public function an_admin_can_delete_a_product()
    {
        $this->assertDatabaseHas('products', ['title'=> $this->product->title]);

        $this->delete(route('admin.products.destroy', $this->product))
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'));

        $this->assertDeleted('products', array($this->product));
    }

    private function productData(): array
    {
        return [
            /* 'image' => UploadedFile::fake()->image('product.jpg')->size(50), */
            'code' => 'PRD1234567',
            'title' => 'Test product',
            'price' => 200,
            'url' => 'test-product-url',
            'quantity' => 10,
            'description' => 'my awesome test product',
            'status' => true,
        ];
    }
}
