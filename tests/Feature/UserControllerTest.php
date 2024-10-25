<?php
//
//namespace Tests\Feature;
//
//use App\Models\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Laravel\Sanctum\Sanctum;
//use PHPUnit\Framework\Attributes\Test;
//use Tests\TestCase;
//
//class UserControllerTest extends TestCase
//{
//    use RefreshDatabase;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Create a user and authenticate
//        $user = User::factory()->create();
//        Sanctum::actingAs($user);
//    }
//
//    public function test_index_returns_successful_response()
//    {
//        User::factory(3)->create();
//
//        $response = $this->getJson('/api/users');
//
//        $response->assertStatus(200)
//            ->assertJsonCount(3);
//    }
//
//    public function test_store_creates_new_category()
//    {
//        $response = $this->postJson('/api/users', [
//            'name' => 'New User',
//        ]);
//
//        $response->assertStatus(201)
//            ->assertJsonFragment(['name' => 'New User']);
//    }
//
//    public function test_store_fails_with_invalid_data()
//    {
//        $response = $this->postJson('/api/users', [
//            'name' => '', // Invalid name
//        ]);
//
//        $response->assertStatus(422)
//            ->assertJsonValidationErrors('name');
//    }
//
//    public function test_show_returns_category()
//    {
//        $user = User::factory()->create();
//
//        $response = $this->getJson("/api/users/$user->id");
//
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $user->name]);
//    }
//
//    public function test_show_fails_for_nonexistent_category()
//    {
//        $response = $this->getJson('/api/users/9999');
//
//        $response->assertStatus(404);
//    }
//
//    public function test_update_modifies_existing_category()
//    {
//        $user = User::factory()->create();
//
//        $response = $this->putJson("/api/users/{$user->id}", [
//            'name' => 'Updated User',
//        ]);
//
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => 'Updated User']);
//    }
//
//    public function test_update_fails_with_invalid_data()
//    {
//        $user = User::factory()->create();
//
//        $response = $this->putJson("/api/users/{$user->id}", [
//            'name' => '', // Invalid name
//        ]);
//
//        $response->assertStatus(422)
//            ->assertJsonValidationErrors('name');
//    }
//
//    public function test_destroy_removes_category()
//    {
//        $user = User::factory()->create();
//
//        $response = $this->deleteJson("/api/users/{$user->id}");
//
//        $response->assertStatus(204);
//        $this->assertDatabaseMissing('users', ['id' => $user->id]);
//    }
//
//    public function test_destroy_fails_for_nonexistent_category()
//    {
//        $response = $this->deleteJson('/api/categories/999');
//
//        $response->assertStatus(404);
//    }
//}
