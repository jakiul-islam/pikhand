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
        Schema::create('search', function (Blueprint $table) {
          
          $table->id();
          $table->unsignedBigInteger('user_id')->nullable();
          $table->string('keyword');
          $table->json('filters')->nullable();
          $table->string('ip_address', 45)->nullable(); // IPv6 পর্যন্ত
          $table->text('user_agent')->nullable();
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search');
    }
};
