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
        // database/migrations/xxxx_create_category_product_table.php
     Schema::create('category_product', function (Blueprint $table) {
      $table->unsignedBigInteger('product_id');
      $table->unsignedBigInteger('subcategory_id');
      $table->primary(['product_id','subcategory_id']);        // composite PK

    // FKs
        $table->foreign('product_id')
              ->references('id')->on('products')
              ->onDelete('cascade');

            $table->foreign('subcategory_id')
                  ->references('id')->on('product_subcategories')
                  ->onDelete('cascade');

          $table->timestamps();              // optional but handy for audits
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
