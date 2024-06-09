<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->actingAs($this->admin, 'admin');
    }

    public function test_admin_can_view(): void
    {
        Category::factory()->count(5)->create();

        $this->get(route('dashboard.categories.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.categories.index')
            ->assertViewHas('categories');
    }

    public function test_admin_can_create(): void
    {
        $category = ['title' => fake()->name()];

        $this->post(route('dashboard.categories.store'), $category)
            ->assertRedirect(route('dashboard.categories.index'));

        $this->assertDatabaseHas('categories', $category);
    }

    public function test_admin_can_edit(): void
    {
        $category = Category::factory()->create();

        $this->get(route('dashboard.categories.edit', $category))
            ->assertStatus(200)
            ->assertViewIs('dashboard.categories.update')
            ->assertViewHas('category', $category);
    }

    public function test_admin_can_update(): void
    {
        $category = Category::factory()->create();
        $newCategory = Category::factory()->make();

        $this->put(route('dashboard.categories.update', $category->id), $newCategory->toArray())
            ->assertRedirect(route('dashboard.categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'title' => $newCategory->title
        ]);
    }

    public function test_admin_can_destroy(): void
    {
        $category = Category::factory()->create();

        $this->delete(route('dashboard.categories.destroy', $category))
            ->assertRedirect(route('dashboard.categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
