<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create()->toArray();
        dd($user);

        $response = $this->actingAs($user)->get(route('admin.products.store'));
        $response->assertViewIs('admin.products.index');
        $response->assertOk();
    }

    public function test_it_stores_a_new_product(): void
    {
        $this->seed(RoleSeeder::class);
        $role = Role::where('name', 'admin')->first();
        $data = Product::factory()->make()->toArray();
        $data['images'][] = UploadedFile::fake()->image('product.jpg')->size(50);
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $user->roles()->attach($role);
        dd($user->roles());
        $response = $this->actingAs($user)->post(route('admin.products.store'), ['product' => $data]);
        dd($response);

        $response->assertRedirect('/admin/products/show');

        $response->dump();
    }

    public function testPrueba(): void
    {
        $data = Product::factory()->make()->toArray();
        $file = $data['images'][] = UploadedFile::fake()->image('product.jpg')->size(50);
        dd($file);
        /** @var \App\Models\User $user */
        $user = User::factory()->hasRoles(1, [
                'name' => 'Editor',
            ])->create();


        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), ['product' => $data]);

        $response->assertStatus(302);
        /* Storage::disk('image')->assertExists($file->hashName()); */

        $response->dump();
    }

    private function productData(): array
    {
        return [
            'category_id' => '1',
            'code' => 'PRD1234567',
            'title' => 'Test product',
            'slug' => 'test-product-slug',
            'description' => 'my awesome test product description',
            'price' => 200,
            'quantity' => 10,
            'images' => [
                UploadedFile::fake()->image('product.jpg')->size(50),
            ],
        ];
    }
}
