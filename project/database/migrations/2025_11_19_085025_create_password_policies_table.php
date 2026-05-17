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
        Schema::create('password_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_name');
            $table->integer('min_length');
            $table->integer('max_length');
            $table->boolean('require_uppercase')->default(false);
            $table->boolean('require_numbers')->default(false);
            $table->boolean('require_special_chars')->default(false);
            $table->integer('password_expiration_days');
            $table->boolean('password_history')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_policies');
    }
};
