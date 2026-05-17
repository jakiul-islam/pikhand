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
        Schema::create('admin_activities', function (Blueprint $table) {
          $table->id();
          $table->string('admin_uuid');
          $table->string('activity_type');
          $table->text('activity_details');
          $table->timestamp('activity_time')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->string('ip_address');
          $table->string('device');
          $table->string('browser');
          $table->string('attachment')->nullable();
          $table->timestamps();
          
          
          $table->foreign('admin_uuid')->references('uuid')->on('admins')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_activities');
    }
};
