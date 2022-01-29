<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product_view_can_be_rendered(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->get(route('products.create'));
        $response->assertViewIs('products.create');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_product_view(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();
        $response = $this->actingAs($user)->get(route('products.create'));
        $response->assertStatus(200);
    }

    public function test_only_admin_can_create_product(): void
    {
        $user = User::factory()->hasRoles(0, ['name' => 'Customer'])->create();
        $response = $this->actingAs($user)->get(route('products.create'));
        $response->assertRedirect(route('home'));
        $response->assertStatus(302);
    }
}
