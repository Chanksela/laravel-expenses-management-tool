<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text("description");
            $table->decimal("amount");
            $table->date("date");
            $table->foreignId("category_id")->constrained()->onDelete('cascade');
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->tinyInteger("transaction_type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
