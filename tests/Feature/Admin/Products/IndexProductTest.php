<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class IndexProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_can_see_product_index(): void
    {
        $user = User::factory()->hasRoles(0, ['name' => 'Customer'])->create();
        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertRedirect(route('home'));
        $response->assertStatus(302);
    }
}
