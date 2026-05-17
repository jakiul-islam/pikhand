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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // ক্যাটাগরির ইমেজ URL
            $table->string('icon')->nullable(); // ক্যাটাগরির আইকন
            $table->string('banner')->nullable(); // ক্যাটাগরির ব্যানার ইমেজ
            $table->integer('order')->default(0);
            $table->string('meta_keywords')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
