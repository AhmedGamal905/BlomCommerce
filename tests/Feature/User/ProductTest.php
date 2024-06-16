<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function test_user_can_view_products()
    {
        $this->get(route('products.index'))
            ->assertStatus(200)
            ->assertViewIs('user.products.index')
            ->assertViewHas('products');
    }

    public function test_admin_can_displays_individual_product()
    {
        $product = Product::factory()->create();

        $this->get(route('products.show', $product))
            ->assertStatus(200)
            ->assertViewIs('user.products.show')
            ->assertViewHas('product', $product);
    }
}
