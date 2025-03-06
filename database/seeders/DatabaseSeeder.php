<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Tester',
            'last_name' => 'Tester',
            'email' => 'test@test.ge',
            'password' => Hash::make('123123'),
        ]);

        User::factory(100)->create();

        $this->call([
                CategorySeeder::class,
                TransactionSeeder::class
            ]);
    }
}
