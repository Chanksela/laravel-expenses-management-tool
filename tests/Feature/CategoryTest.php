<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_has_many_transactions()
    {
        $user = User::factory()->create(); // Creates a unique user
        $category = Category::factory()->create();

        $transactions = Transaction::factory()->count(3)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $this->assertCount(3, $category->transactions);
    }

    public function test_category_without_transactions()
    {
        $category = Category::factory()->create();

        $this->assertCount(0, $category->transactions);
    }

}
