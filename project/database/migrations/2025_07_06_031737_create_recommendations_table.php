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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('recommended_product_id');
            $table->integer('priority')->default(0);
            $table->string('type')->nullable();
            $table->unique(['user_id','product_id', 'recommended_product_id']);
            $table->timestamps();
            
            $table->foreign('user_id') ->references('id')->on('users') ->cascadeOnDelete();
            $table->foreign('product_id') ->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('recommended_product_id') ->references('id')->on('products') ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomandition');
    }
};
