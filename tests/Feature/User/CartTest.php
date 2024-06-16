<?php

namespace Tests\Feature\User;

use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    public function test_user_can_view_cart(): void
    {
        $this->get(route('cart.show'))
            ->assertStatus(200)
            ->assertViewIs('user.cart')
            ->assertViewHas('cartItems');
    }

    public function test_user_can_store_a_product_in_cart(): void
    {
        $product = Product::factory()->create();

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ])
            ->assertRedirect()
            ->assertSessionHas(['success', 'cart']);
    }

    public function test_user_can_remove_a_product_from_cart(): void
    {
        $product = Product::factory()->create();

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ])->assertRedirect()
            ->assertSessionHas(['success', 'cart']);

        $this->post(route('cart.destroy'), [
            'product_id' => $product->id,
        ])
            ->assertSessionMissing('cart.' . $product->id)
            ->assertSessionHas('success')
            ->assertRedirect();
    }
}
