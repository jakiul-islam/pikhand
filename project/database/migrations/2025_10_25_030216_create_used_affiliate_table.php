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
        Schema::create('used_affiliate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliate_id');
            $table->unsignedBigInteger('refaret_user_id');
            $table->unsignedBigInteger('order_id');
            $table->string('total_order')->default(0);
            $table->string('total_commission')->default(0);
            $table->timestamps();
            
            
            $table->foreign('affiliate_id')->references('id')->on('affiliate')->onDelete('cascade');
            $table->foreign('refaret_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_affiliate');
    }
};
