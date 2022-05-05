<?php

namespace Tests\Feature\Admin\Products;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Arr;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $data = Product::factory()->make()->toArray();
        $data['images'][] = UploadedFile::fake()->image('product.jpg')->size(50);

        $user = User::factory()->hasRoles(1, [
                'name' => 'Admin',
            ])->create();

        $this->actingAs($user)
            ->post(route('admin.products.store'), $data);

        $this->assertDatabaseHas('products', Arr::except($data, ['images']));

        //sessionhaserrors

        //Storage::fake('local');
        //Storage::disk('local')->assertExists("images/1/{$data['images']->hashName()}");
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
            /* 'images' => [
                UploadedFile::fake()->image('product.jpg')->size(50),
            ], */
        ];
    }
}
