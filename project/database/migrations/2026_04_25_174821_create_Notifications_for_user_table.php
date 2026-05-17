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
        Schema::create('Notifications_for_user', function (Blueprint $table) {
            
            
            $table->id();
            $table->string('title'); // নোটিফিকেশন টাইটেল
            $table->text('message'); // নোটিফিকেশন মেসেজ
            $table->string('type')->default('info'); // success, error, warning, info
            $table->string('icon')->nullable(); // fa-bell, fa-check
            $table->string('url')->nullable(); // ক্লিক করলে কোথায় যাবে
            $table->unsignedBigInteger('user_id')->nullable(); // কার জন্য, null = সবাই
            $table->uuid('created_by')->nullable(); // কে পাঠাইছে
            $table->timestamp('read_at')->nullable(); // কখন পড়ছে
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('uuid')->on('admins')->onDelete('set null');
            $table->index(['user_id', 'read_at']);
            
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
