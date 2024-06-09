<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_login_form(): void
    {
        $this->get(route('dashboard.login.index'))
            ->assertStatus(200)
            ->assertViewIs('admin.login');
    }

    public function test_admin_can_authenticate(): void
    {
        $admin = Admin::factory()->create();

        $this->post(route('dashboard.login.post'), [
            'email' => 'admin@admin.com',
            'password' => 'admin@admin.com',
        ])->assertRedirect(route('dashboard.welcome'));

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_displays_error_for_invalid_email(): void
    {
        $this->post(route('dashboard.login.post'), [
            'email' => 'invalid@example.com',
            'password' => 'Invalid password',
        ])->assertSessionHasErrors('email');
    }

    public function test_logs_out_authenticated_admin_user(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        $this->post(route('dashboard.logout'))
            ->assertViewIs('admin.login');

        $this->assertGuest('admin');
    }
}
