<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_description_is_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/transactions', [
            'description' => '',
            'amount' => 100,
            'date' => '2025-03-06',
            'category_id' => $category->id,
            'transaction_type' => 2,
        ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_amount_is_numeric()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/transactions', [
            'description' => 'New Expense',
            'amount' => 'not-a-number',
            'date' => '2025-03-06',
            'category_id' => $category->id,
            'transaction_type' => 2,
        ]);

        $response->assertSessionHasErrors('amount');
    }
}
