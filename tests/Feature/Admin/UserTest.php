<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->actingAs($this->admin, 'admin');
    }
    public function test_admin_can_view_users(): void
    {
        User::factory()->count(10)->create();

        $this->get(route('dashboard.users.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.users.index')
            ->assertViewHas('users');
    }
}
