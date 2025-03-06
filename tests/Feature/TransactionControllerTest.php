<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_filter_transactions_by_category()
    {
        $user = User::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        // Creating transactions for both categories
        $transaction1 = Transaction::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'transaction_type' => 1, // Income
            'amount' => 100
        ]);
        $transaction2 = Transaction::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'transaction_type' => 2, // Expense
            'amount' => 50
        ]);

        $response = $this->actingAs($user)->get(route('transactions.index', ['category_id' => $category1->id]));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($transaction1->description);
        $response->assertDontSee($transaction2->description);
    }

    public function test_user_can_calculate_total_income_and_expense()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $income = Transaction::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'transaction_type' => 1, 
            'date' => '2025-03-06',
            'amount' => 125
        ]);
        $expense = Transaction::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'transaction_type' => 2,
            'date' => '2025-03-06',
            'amount' => 30
        ]);

        $response = $this->actingAs($user)->get(route('transactions.index'));

        $response->assertSee('$125');
        $response->assertSee('$30');
        $response->assertSee('$95');
    }
}
