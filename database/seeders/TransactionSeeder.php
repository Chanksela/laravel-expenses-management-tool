<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0){
            User::factory(100)->create();
        }

        if (Category::count() === 0){
            $this->call(CategorySeeder::class);
        }

        Transaction::factory(50)->create();
    }
}
