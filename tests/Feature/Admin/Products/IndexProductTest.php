<?php

namespace Tests\Feature\Admin\Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductTest extends TestCase
{
    use RefreshDatabase;

    public function testOnlyAdminManagementProductsView(): void
    {
        $user = User::factory()->hasRoles(0, ['name' => 'Customer'])->create();
        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertRedirect(route('home'));
        $response->assertStatus(302);
    }
}
