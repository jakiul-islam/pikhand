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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->decimal('amount',   10, 2); 
            $table->string('currency',   3)->default('BDT');
            $table->enum('method', [              
                'cash_on_delivery',
                'bkash',
                'nagads',
                'card',
                'stripe',
                'paypal'
            ]);
            $table->enum('status', [                 
                'pending',      
                'authorized',   
                'paid',         
                'failed',       
                'refunded'      
            ])->default('pending');
            $table->string('transaction_id')->nullable()->unique();  
            $table->json('payload')->nullable();      
            $table->timestamp('captured_at')->nullable(); 
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
