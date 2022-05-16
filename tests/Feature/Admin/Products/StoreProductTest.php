<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    public function testOneProductCanBeStored(): void
    {
        $data = Product::factory()->make()->toArray();
        $data['images'][] = UploadedFile::fake()->image('product.jpg')->size(50);

        $user = User::factory()->hasRoles(1, [
                'name' => 'Admin',
            ])->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), $data);

        $response->assertStatus(302);
    }

    public function testDataIsStoredInDatabase(): void
    {
        Storage::fake('image');
        $data = Product::factory()->make()->toArray();
        $data['images'][] = UploadedFile::fake()->image('product.jpg')->size(50);

        $user = User::factory()->hasRoles(1, [
                'name' => 'Admin',
            ])->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), $data);
        $response->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', Arr::except($data, ['images']));

        $product = Product::latest('id')->with('images')->first();
        $image = $product->images->first();

        Storage::disk('image')->assertExists($product->id . '/' . $image->file_name);
    }

    private function productData(): array
    {
        return [
            'category_id' => '1',
            'code' => 'PRD1234567',
            'title' => 'Test product',
            'slug' => 'test-product-slug',
            'description' => 'my awesome test product description',
            'price' => 200000,
            'quantity' => 10,
        ];
    }
}
