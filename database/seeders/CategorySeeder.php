<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();


        DB::table('categories')->insert([
            [
                'name' => "rent",
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => "utilities",
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => "food",
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => "salary",
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
