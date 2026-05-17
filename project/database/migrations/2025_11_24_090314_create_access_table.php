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
        Schema::create('access', function (Blueprint $table) {
          $table->id();
          $table->string('pagename', 225);
          $table->uuid('admin_uuid');
          $table->timestamps();
            
            
          $table->foreign('pagename')->references('pageName')->on('admin_page')->onDelete('cascade');
          $table->foreign('admin_uuid')->references('uuid')->on('admins')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access');
    }
};
