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
        Schema::create('feature_switches', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // যেমন: registration, checkout
            $table->string('name')->nullable(); // প্রদর্শনের জন্য: "User Registration"
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_switch');
    }
};
