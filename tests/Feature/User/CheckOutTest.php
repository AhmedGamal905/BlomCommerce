<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckOutTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    public function test_user_can_view_checkOut(): void
    {
        $product = Product::factory()->create([
            'price' => 50
        ]);

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ])
            ->assertRedirect()
            ->assertSessionHas(['success', 'cart']);

        $this->get(route('checkout.index'))
            ->assertViewIs('user.checkOut')
            ->assertViewHas('totalPrice', 100);
    }
    public function test_user_can_not_view_checkOut_with_no_items(): void
    {
        $this->get(route('checkout.index'))
            ->assertSessionHas('error')
            ->assertRedirect(route('cart.show'));
    }
    public function test_user_can_checkOut(): void
    {
        $product = Product::factory()->create();

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->post(route('checkout.store'), [
            'name' => fake()->name,
            'building_number' => fake()->buildingNumber,
            'street_name' => fake()->streetName,
            'city' => fake()->city,
            'postcode' => fake()->postcode,
            'phone' => fake()->phoneNumber,
        ])
            ->assertRedirect(route('orders.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'id' => Order::latest('id')->first()->id,
        ]);
    }
}
