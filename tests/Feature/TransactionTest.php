<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_transaction()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/transactions', [
            'description' => 'New Expense',
            'amount' => 100,
            'date' => '2025-03-06',
            'category_id' => $category->id,
            'transaction_type' => 2,
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('transactions', [
            'description' => 'New Expense',
            'amount' => 100,
        ]);
    }

    public function test_user_can_update_transaction()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $transaction = Transaction::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

        $response = $this->actingAs($user)->put("/transactions/{$transaction->id}", [
            'description' => 'Updated Expense',
            'amount' => 150,
            'date' => '2025-03-07',
            'category_id' => $category->id,
            'transaction_type' => 2,  // Expense
        ]);

        $response->assertStatus(Response::HTTP_FOUND); // Redirect after update
        $this->assertDatabaseHas('transactions', [
            'description' => 'Updated Expense',
            'amount' => 150,
        ]);
    }

    public function user_can_delete_transaction()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $transaction = Transaction::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

        $response = $this->actingAs($user)->delete("/transactions/{$transaction->id}");

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id
        ]);
    }
}
