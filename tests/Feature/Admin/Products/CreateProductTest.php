<?php

namespace Tests\Feature\Admin\Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanAccessToCreateProductView(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertOk();
        $response->assertViewIs('admin.products.create');
        $response->assertStatus(200);
    }

    public function testOnlyAnAdminCanAccessToCreateProductView(): void
    {
        $user = User::factory()->hasRoles(0, ['name' => 'Customer'])->create();
        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertRedirect(route('home'));
        $response->assertStatus(302);
    }
}
