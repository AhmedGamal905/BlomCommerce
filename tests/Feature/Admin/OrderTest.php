<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $order;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->order = Order::factory()->create();

        $this->actingAs($this->admin, 'admin');
    }

    public function test_admin_can_view_orders_index()
    {
        $this->get(route('dashboard.orders.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.orders.index')
            ->assertViewHas('orders');
    }

    public function test_admin_can_view_order_details()
    {
        $this->get(route('dashboard.orders.show', $this->order))
            ->assertStatus(200)
            ->assertViewIs('dashboard.orders.show')
            ->assertViewHas('order');
    }

    public function test_admin_can_update_order_status()
    {
        $this->put(route('dashboard.orders.update', $this->order), [
            'status' => OrderStatus::CANCELLED->value,
        ])->assertRedirect(route('dashboard.orders.show', $this->order));

        $this->assertEquals(OrderStatus::CANCELLED->value, $this->order->fresh()->status);
    }
}
