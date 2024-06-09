<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->actingAs($this->admin, 'admin');
    }
    public function test_admin_can_view_products(): void
    {
        $this->get(route('dashboard.products.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.products.index')
            ->assertViewHas('products');
    }

    public function test_admin_can_create(): void
    {
        $this->get(route('dashboard.products.create'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.products.create')
            ->assertViewHas('categories');
    }

    public function test_admin_can_store(): void
    {
        Storage::fake('media');

        $category = Category::factory()->create();

        $data = [
            'category_id' => $category->id,
            'title' => 'Test Product',
            'description' => 'This is a test description',
            'price' => '99.99',
            'images' => [
                UploadedFile::fake()->image('image1.jpg'),
            ],
        ];

        $this->post(route('dashboard.products.store'), $data)
            ->assertRedirect(route('dashboard.products.index'));

        $this->assertDatabaseHas('products', [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        $product = Product::latest()->first();

        $this->assertCount(1, $product->getMedia('product_images'));
    }

    public function test_admin_can_edit(): void
    {
        $product = Product::factory()->create();

        $this->get(route('dashboard.products.edit', $product))
            ->assertStatus(200)
            ->assertViewIs('dashboard.products.update')
            ->assertViewHas('product', $product)
            ->assertViewHas('categories');
    }

    public function test_admin_can_update(): void
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $data = [
            'category_id' => $category->id,
            'title' => 'Updated Product',
            'description' => 'This is an updated description',
            'price' => '199.99',
        ];
        $this->put(route('dashboard.products.update', $product), $data)
            ->assertRedirect(route('dashboard.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);
    }

    public function test_admin_can_destroy(): void
    {
        $product = Product::factory()->create();

        $this->delete(route('dashboard.products.destroy', $product))
            ->assertRedirect(route('dashboard.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
