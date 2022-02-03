<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_create_product_view(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->get('/admin/products/create');
        $response->assertViewIs('admin.products.create');
        $response->assertOk();
    }

    public function test_create_product_view_can_be_rendered(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->get(route('admin.products.store'));
        $response->assertViewIs('admin.products.index');
        $response->assertOk();
    }
    
    public function test_it_stores_a_new_product(): void
    {
        $this->withoutExceptionHandling();

        $data = $this->productData();
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->post(route('admin.products.store'), $data);
        $response->assertRedirect();
         
        $this->assertDatabaseHas('products', $data, null);
    }

    private function productData(): array
    {
        return [
/*             'image' => UploadedFile::fake()->image('test_product.jpg', 1800, 150)->size(50),
 */         'code' => 'ABC0987654',
            'title' => 'Test product',
            'price' => 200,
            'url' => 'testproducturl',
            'quantity' => 10,
            'description' => 'my awesome test product',
            'status' => 1,
        ];
    }
}
