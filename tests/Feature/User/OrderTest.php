<?php

namespace Tests\Feature\User;

use App\Models\Order;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    public function test_user_can_view_orders(): void
    {
        $this->get(route('orders.index'))
            ->assertStatus(200)
            ->assertViewIs('user.orders.index')
            ->assertViewHas('orders');
    }

    public function test_user_can_view_an_order(): void
    {
        $order = Order::factory()->create();

        $this->get(route('orders.show', $order))
            ->assertStatus(200)
            ->assertViewIs('user.orders.show')
            ->assertViewHas('order');
    }
}
