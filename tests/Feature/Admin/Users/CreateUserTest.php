<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminCanCreateUser(): void
    {
        $user = User::factory()->create();
        //dd($user->all());

        $response = $this->actingAs($user)->get(route('admin.users.create'));
        dd($response->getContent());
        $response->assertViewIs('admin.users.create');
        $response->assertStatus(200);
    }
}
