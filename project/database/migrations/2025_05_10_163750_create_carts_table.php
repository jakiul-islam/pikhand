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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ipAddress')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->decimal('product_price');
            $table->integer('quantity')->default(1);
            $table->enum('status', [
                'Active',     
                'Ordered',  
                'Shipped',     
                'Completed',   
                'Cancelled', 
            ])->default('Active');
            $table->string('coupon_code')->nullable();
            $table->timestamps();
            
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
