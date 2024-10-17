<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_index_returns_successful_response()
    {
        Product::factory(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_store_creates_new_category()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'New Product',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Product']);
    }

    public function test_store_fails_with_invalid_data()
    {
        $response = $this->postJson('/api/products', [
            'name' => '', // Invalid name
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_show_returns_category()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/$product->id");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $product->name]);
    }

    public function test_show_fails_for_nonexistent_category()
    {
        $response = $this->getJson('/api/products/9999');

        $response->assertStatus(404);
    }

    public function test_update_modifies_existing_category()
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated Product',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Product']);
    }

    public function test_update_fails_with_invalid_data()
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => '', // Invalid name
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_destroy_removes_category()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_destroy_fails_for_nonexistent_category()
    {
        $response = $this->deleteJson('/api/categories/999');

        $response->assertStatus(404);
    }
}
