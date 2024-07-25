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
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("transaction_type")->nullable();
            $table->integer("transaction_id")->nullable();
            $table->decimal("amount", $precision = 34, $scale = 4);
            $table->decimal("from", $precision = 34, $scale = 4)->nullable();
            $table->decimal("to", $precision = 34, $scale = 4)->nullable();
            $table->string("type");
            $table->softDeletes();
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
